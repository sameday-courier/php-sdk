<?php

namespace Sameday\HttpClients;

use Sameday\Http\SamedayRawResponse;
use Sameday\Exceptions\SamedaySDKException;

use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Exception\RingException;
use GuzzleHttp\Exception\RequestException;

/**
 * Class that encapsulates a HTTP client as guzzle client.
 *
 * @package Sameday
 */
class SamedayGuzzleHttpClient implements SamedayHttpClientInterface
{
    /**
     * @var \GuzzleHttp\Client The Guzzle client.
     */
    protected $client;

    /**
     * SamedayGuzzleHttpClient constructor.
     *
     * @param Client|null $client The Guzzle client.
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @inheritdoc
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $options = [
            'headers' => $headers,
            'body' => $body,
            'timeout' => $timeOut,
            'connect_timeout' => 10,
        ];
        $request = $this->client->createRequest($method, $url, $options);

        try {
            $rawResponse = $this->client->send($request);
        } catch (RequestException $e) {
            $rawResponse = $e->getResponse();

            if (!$rawResponse || $e->getPrevious() instanceof RingException) {
                throw new SamedaySDKException($e->getMessage(), $e->getCode());
            }
        }

        $rawHeaders = $this->getHeadersAsString($rawResponse);
        $rawBody = $rawResponse->getBody();
        $httpStatusCode = $rawResponse->getStatusCode();

        return new SamedayRawResponse($rawHeaders, $rawBody, $httpStatusCode);
    }

    /**
     * Return the guzzle array of headers as a string.
     *
     * @param ResponseInterface $response The Guzzle response.
     *
     * @return string
     */
    public function getHeadersAsString(ResponseInterface $response)
    {
        $headers = $response->getHeaders();
        $rawHeaders = [];
        foreach ($headers as $name => $values) {
            $rawHeaders[] = $name . ': ' . implode(', ', $values);
        }

        return implode("\r\n", $rawHeaders);
    }
}

<?php

namespace Sameday\HttpClients;

use Sameday\Http\SamedayRawResponse;
use Sameday\Exceptions\SamedaySDKException;

/**
 * Class that encapsulates a HTTP client as curl.
 *
 * @package Sameday
 */
class SamedayCurlHttpClient implements SamedayHttpClientInterface
{
    /**
     * @var string The client error message.
     */
    protected $errorMessage = '';

    /**
     * @var int The curl client error code.
     */
    protected $errorCode = 0;

    /**
     * @var string|boolean The raw response from the server.
     */
    protected $rawResponse;

    /**
     * @var SamedayCurl Procedural curl as object.
     */
    protected $curl;

    /**
     * SamedayCurlHttpClient constructor.
     *
     * @param SamedayCurl|null $curl Procedural curl as object.
     */
    public function __construct(SamedayCurl $curl = null)
    {
        $this->curl = $curl ?: new SamedayCurl();
    }

    /**
     * @inheritdoc
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $this->openConnection($url, $method, $body, $headers, $timeOut);
        $this->sendRequest();

        if ($errorCode = $this->curl->errno()) {
            throw new SamedaySDKException($this->curl->error(), $errorCode);
        }

        // Separate the raw headers from the raw body
        list($rawHeaders, $rawBody) = $this->extractResponseHeadersAndBody();

        $this->closeConnection();

        return new SamedayRawResponse($rawHeaders, $rawBody);
    }

    /**
     * Opens a new curl connection.
     *
     * @param string $url The endpoint to send the request to.
     * @param string $method The request method.
     * @param string $body The body of the request.
     * @param array $headers The request headers.
     * @param int $timeOut The timeout in seconds for the request.
     */
    public function openConnection($url, $method, $body, array $headers, $timeOut)
    {
        $options = [
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $this->compileRequestHeaders($headers),
            CURLOPT_URL => $url,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => $timeOut,
            CURLOPT_RETURNTRANSFER => true, // Return response as string
            CURLOPT_HEADER => true, // Enable header processing
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
        ];

        if ($method !== 'GET') {
            $options[CURLOPT_POSTFIELDS] = $body;
        }

        $this->curl->init();
        $this->curl->setoptArray($options);
    }

    /**
     * Closes an existing curl connection.
     */
    public function closeConnection()
    {
        $this->curl->close();
    }

    /**
     * Send the request and get the raw response from curl.
     */
    public function sendRequest()
    {
        $this->rawResponse = $this->curl->exec();
    }

    /**
     * Compiles the request headers into a curl-friendly format.
     *
     * @param array $headers The request headers.
     *
     * @return array
     */
    public function compileRequestHeaders(array $headers)
    {
        $return = [];

        foreach ($headers as $key => $value) {
            $return[] = $key . ': ' . $value;
        }

        return $return;
    }

    /**
     * Extracts the headers and the body into a two-part array.
     *
     * @return array
     */
    public function extractResponseHeadersAndBody()
    {
        $parts = explode("\r\n\r\n", $this->rawResponse);
        $rawBody = array_pop($parts);
        $rawHeaders = implode("\r\n\r\n", $parts);

        return [trim($rawHeaders), trim($rawBody)];
    }
}

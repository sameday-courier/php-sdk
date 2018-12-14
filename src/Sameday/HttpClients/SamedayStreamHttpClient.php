<?php

namespace Sameday\HttpClients;

use Sameday\Http\SamedayRawResponse;
use Sameday\Exceptions\SamedaySDKException;

/**
 * Class that encapsulates a HTTP client as php streams.
 *
 * @package Sameday
 */
class SamedayStreamHttpClient implements SamedayHttpClientInterface
{
    /**
     * @var SamedayStream Procedural stream wrapper as object.
     */
    protected $stream;

    /**
     * SamedayStreamHttpClient constructor.
     *
     * @param SamedayStream|null $stream Procedural stream wrapper as object.
     */
    public function __construct(SamedayStream $stream = null)
    {
        $this->stream = $stream ?: new SamedayStream();
    }

    /**
     * @inheritdoc
     */
    public function send($url, $method, $body, array $headers, $timeOut)
    {
        $options = [
            'http' => [
                'method' => $method,
                'header' => $this->compileHeader($headers),
                'content' => $body,
                'timeout' => $timeOut,
                'ignore_errors' => true
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
                'allow_self_signed' => true, // All root certificates are self-signed.
            ],
        ];

        $this->stream->streamContextCreate($options);
        $rawBody = $this->stream->fileGetContents($url);
        $rawHeaders = $this->stream->getResponseHeaders();

        if ($rawBody === false || empty($rawHeaders)) {
            throw new SamedaySDKException('Stream returned an empty response.');
        }

        $rawHeaders = implode("\r\n", $rawHeaders);

        return new SamedayRawResponse($rawHeaders, $rawBody);
    }

    /**
     * Formats the headers for use in the stream wrapper.
     *
     * @param array $headers The request headers.
     *
     * @return string
     */
    public function compileHeader(array $headers)
    {
        $header = [];
        foreach ($headers as $k => $v) {
            $header[] = $k . ': ' . $v;
        }

        return implode("\r\n", $header);
    }
}

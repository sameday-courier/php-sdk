<?php

namespace Sameday\HttpClients;

/**
 * Abstraction for the procedural stream elements so that the functions can be
 * mocked and the implementation can be tested.
 *
 * @package Sameday
 */
class SamedayStream
{
    /**
     * @var resource Context stream resource instance.
     */
    protected $stream;

    /**
     * @var array Response headers from the stream wrapper.
     */
    protected $responseHeaders = [];

    /**
     * Make a new context stream reference instance.
     *
     * @param array $options
     *
     * @codeCoverageIgnore
     */
    public function streamContextCreate(array $options)
    {
        $this->stream = stream_context_create($options);
    }

    /**
     * The response headers from the stream wrapper.
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Send a stream wrapped request.
     *
     * @param string $url
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    public function fileGetContents($url)
    {
        $rawResponse = file_get_contents($url, false, $this->stream);
        $this->responseHeaders = $http_response_header ?: [];

        return $rawResponse;
    }
}

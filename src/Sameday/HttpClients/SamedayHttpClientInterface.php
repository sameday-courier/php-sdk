<?php

namespace Sameday\HttpClients;

/**
 * Interface that encapsulates a HTTP client.
 *
 * @package Sameday
 */
interface SamedayHttpClientInterface
{
    /**
     * Sends a request to the server and returns the raw response.
     *
     * @param string $url The endpoint URL to send the request to.
     * @param string $method The request method.
     * @param string $body The body of the request.
     * @param array $headers The request headers.
     * @param int $timeOut The timeout in seconds for the request.
     *
     * @return \Sameday\Http\SamedayRawResponse Raw response from the server.
     *
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function send($url, $method, $body, array $headers, $timeOut);
}

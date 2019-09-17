<?php

namespace Sameday\HttpClients;

use Sameday\Exceptions\SamedaySDKException;
use Sameday\Http\SamedayRawResponse;

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
     * @return SamedayRawResponse Raw response from the server.
     *
     * @throws SamedaySDKException
     */
    public function send($url, $method, $body, array $headers, $timeOut);
}

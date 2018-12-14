<?php

namespace Sameday\HttpClients;

use GuzzleHttp\Client;

/**
 * Factory class to build a HTTP client.
 *
 * @package Sameday
 */
class HttpClientsFactory
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        // A factory constructor should never be invoked.
    }

    /**
     * HTTP client generation.
     *
     * @param SamedayHttpClientInterface|Client|string|null $handler Handler to use for this HTTP client.
     *
     * @throws \RuntimeException If the cURL extension or the Guzzle client aren't available (if required).
     * @throws \InvalidArgumentException If the http client handler isn't "curl", "stream", "guzzle", or an instance of Sameday\HttpClients\SamedayHttpClientInterface.
     *
     * @return SamedayHttpClientInterface
     */
    public static function createHttpClient($handler)
    {
        if (!$handler) {
            return self::detectDefaultClient();
        }

        if ($handler instanceof SamedayHttpClientInterface) {
            return $handler;
        }

        if ($handler instanceof Client) {
            return new SamedayGuzzleHttpClient($handler);
        }

        if ('stream' === $handler) {
            return new SamedayStreamHttpClient();
        }

        if ('curl' === $handler) {
            if (!extension_loaded('curl')) {
                throw new \RuntimeException('The cURL extension must be loaded in order to use the "curl" handler.');
            }

            return new SamedayCurlHttpClient();
        }

        if ('guzzle' === $handler) {
            if (!class_exists('GuzzleHttp\Client')) {
                throw new \RuntimeException('The Guzzle HTTP client must be included in order to use the "guzzle" handler.');
            }

            return new SamedayGuzzleHttpClient();
        }

        throw new \InvalidArgumentException('The http client handler must be set to "curl", "stream", "guzzle", be an instance of GuzzleHttp\Client or an instance of Sameday\HttpClients\SamedayHttpClientInterface');
    }

    /**
     * Detect default HTTP client.
     *
     * @return SamedayHttpClientInterface
     */
    private static function detectDefaultClient()
    {
        if (extension_loaded('curl')) {
            return new SamedayCurlHttpClient();
        }

        if (class_exists('GuzzleHttp\Client')) {
            return new SamedayGuzzleHttpClient();
        }

        return new SamedayStreamHttpClient();
    }
}

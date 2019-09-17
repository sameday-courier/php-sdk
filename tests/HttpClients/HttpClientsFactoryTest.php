<?php

namespace Sameday\Tests\HttpClients;

use PHPUnit_Framework_TestCase;
use Sameday\HttpClients\SamedayCurlHttpClient;
use Sameday\HttpClients\SamedayGuzzleHttpClient;
use Sameday\HttpClients\SamedayStreamHttpClient;
use Sameday\HttpClients\HttpClientsFactory;
use GuzzleHttp\Client;

class HttpClientsFactoryTest extends PHPUnit_Framework_TestCase
{
    const COMMON_NAMESPACE = 'Sameday\HttpClients\\';
    const COMMON_INTERFACE = 'Sameday\HttpClients\SamedayHttpClientInterface';

    /**
     * @param mixed  $handler
     * @param string $expected
     *
     * @dataProvider httpClientsProvider
     */
    public function testCreateHttpClient($handler, $expected)
    {
        $httpClient = HttpClientsFactory::createHttpClient($handler);

        $this->assertInstanceOf(self::COMMON_INTERFACE, $httpClient);
        $this->assertInstanceOf($expected, $httpClient);
    }

    /**
     * @return array
     */
    public function httpClientsProvider()
    {
        $clients = [
          ['guzzle', self::COMMON_NAMESPACE . 'SamedayGuzzleHttpClient'],
          ['stream', self::COMMON_NAMESPACE . 'SamedayStreamHttpClient'],
          [new Client(), self::COMMON_NAMESPACE . 'SamedayGuzzleHttpClient'],
          [new SamedayGuzzleHttpClient(), self::COMMON_NAMESPACE . 'SamedayGuzzleHttpClient'],
          [new SamedayStreamHttpClient(), self::COMMON_NAMESPACE . 'SamedayStreamHttpClient'],
          [null, self::COMMON_INTERFACE],
        ];

        if (extension_loaded('curl')) {
            $clients[] = ['curl', self::COMMON_NAMESPACE . 'SamedayCurlHttpClient'];
            $clients[] = [new SamedayCurlHttpClient(), self::COMMON_NAMESPACE . 'SamedayCurlHttpClient'];
        }

        return $clients;
    }
}

<?php

namespace Sameday\Tests\HttpClients;

use Mockery\MockInterface;
use Sameday\HttpClients\SamedayCurlHttpClient;

class SamedayCurlHttpClientTest extends AbstractTestHttpClient
{
    /**
     * @var MockInterface|\Sameday\HttpClients\SamedayCurl
     */
    protected $curl;

    /**
     * @var SamedayCurlHttpClient
     */
    protected $client;

    protected function setUp()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL must be installed to test cURL client handler.');
        }

        $this->curl = \Mockery::mock('Sameday\HttpClients\SamedayCurl');
        $this->client = new SamedayCurlHttpClient($this->curl);
    }

    public function testCanOpenGetCurlConnection()
    {
        $this->curl
            ->shouldReceive('init')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('setoptArray')
            ->with(\Mockery::on(function ($arg) {
                // array_diff() will sometimes trigger error on child-arrays
                if (['X-Foo-Header: X-Bar'] !== $arg[CURLOPT_HTTPHEADER]) {
                    return false;
                }
                unset($arg[CURLOPT_HTTPHEADER]);

                $diff = array_diff($arg, [
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_URL => 'http://foo.com',
                    CURLOPT_CONNECTTIMEOUT => 10,
                    CURLOPT_TIMEOUT => 123,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => true,
                ]);

                return count($diff) === 0;
            }))
            ->once()
            ->andReturn(null);

        $this->client->openConnection('http://foo.com', 'GET', 'foo_body', ['X-Foo-Header' => 'X-Bar'], 123);
    }

    public function testCanOpenCurlConnectionWithPostBody()
    {
        $this->curl
            ->shouldReceive('init')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('setoptArray')
            ->with(\Mockery::on(function ($arg) {
                // array_diff() will sometimes trigger error on child-arrays
                if ([] !== $arg[CURLOPT_HTTPHEADER]) {
                    return false;
                }
                unset($arg[CURLOPT_HTTPHEADER]);

                $diff = array_diff($arg, [
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_URL => 'http://bar.com',
                    CURLOPT_CONNECTTIMEOUT => 10,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_POSTFIELDS => 'baz=bar',
                ]);

                return count($diff) === 0;
            }))
            ->once()
            ->andReturn(null);

        $this->client->openConnection('http://bar.com', 'POST', 'baz=bar', [], 60);
    }

    public function testCanCloseConnection()
    {
        $this->curl
            ->shouldReceive('close')
            ->once()
            ->andReturn(null);

        $this->client->closeConnection();
    }

    public function testIsolatesTheHeaderAndBody()
    {
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn($this->fakeRawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeader, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeader, trim($this->fakeRawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesProxyHeaders()
    {
        $rawHeader = $this->fakeRawProxyHeader . $this->fakeRawHeader;
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesProxyHeadersWithCurlBug2()
    {
        $rawHeader = $this->fakeRawProxyHeader2 . $this->fakeRawHeader;
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesRedirectHeaders()
    {
        $rawHeader = $this->fakeRawRedirectHeader . $this->fakeRawHeader;
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testCanSendNormalRequest()
    {
        $this->curl
            ->shouldReceive('init')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('setoptArray')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn($this->fakeRawHeader . $this->fakeRawBody);
        $this->curl
            ->shouldReceive('errno')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('close')
            ->once()
            ->andReturn(null);

        $response = $this->client->send('http://foo.com/', 'GET', '', [], 60);

        $this->assertInstanceOf('Sameday\Http\SamedayRawResponse', $response);
        $this->assertEquals($this->fakeRawBody, $response->getBody());
        $this->assertEquals($this->fakeHeadersAsArray, $response->getHeaders());
        $this->assertEquals(200, $response->getHttpStatusCode());
    }

    /**
     * @expectedException \Sameday\Exceptions\SamedaySDKException
     */
    public function testThrowsExceptionOnClientError()
    {
        $this->curl
            ->shouldReceive('init')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('setoptArray')
            ->once()
            ->andReturn(null);
        $this->curl
            ->shouldReceive('exec')
            ->once()
            ->andReturn(false);
        $this->curl
            ->shouldReceive('errno')
            ->once()
            ->andReturn(123);
        $this->curl
            ->shouldReceive('error')
            ->once()
            ->andReturn('Foo error');

        $this->client->send('http://foo.com/', 'GET', '', [], 60);
    }
}

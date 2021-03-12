<?php

namespace Sameday\Tests\HttpClients;

use PHPUnit\Framework\TestCase;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\HttpClients\SamedayCurl;
use Sameday\HttpClients\SamedayCurlHttpClient;

class SamedayCurlHttpClientTest extends AbstractTestHttpClient
{
    /**
     * @var SamedayCurl
     */
    protected $curl;

    /**
     * @var SamedayCurlHttpClient
     */
    protected $client;

    private function setUpRequirements()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped('cURL must be installed to test cURL client handler.');
        }

        $this->curl = $this->createMock('Sameday\HttpClients\SamedayCurl');
        $this->client = new SamedayCurlHttpClient($this->curl);
    }

    public function testCanOpenGetCurlConnection()
    {
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('setoptArray')
            ->will($this->returnCallback(static function ($arg) {
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
            ->willReturn(null);

        $this->client->openConnection('http://foo.com', 'GET', 'foo_body', ['X-Foo-Header' => 'X-Bar'], 123);
    }

    public function testCanOpenCurlConnectionWithPostBody()
    {
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('setoptArray')
            ->will($this->returnCallback(static function ($arg) {
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
            ->willReturn(null);

        $this->client->openConnection('http://bar.com', 'POST', 'baz=bar', [], 60);
    }

    public function testCanCloseConnection()
    {
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('close')
            ->willReturn(null);

        $this->client->closeConnection();
    }

    public function testIsolatesTheHeaderAndBody()
    {
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn($this->fakeRawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeader, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeader, trim($this->fakeRawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesProxyHeaders()
    {
        $this->setUpRequirements();
        $rawHeader = $this->fakeRawProxyHeader . $this->fakeRawHeader;
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesProxyHeadersWithCurlBug2()
    {
        $this->setUpRequirements();
        $rawHeader = $this->fakeRawProxyHeader2 . $this->fakeRawHeader;
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    public function testProperlyHandlesRedirectHeaders()
    {
        $this->setUpRequirements();
        $rawHeader = $this->fakeRawRedirectHeader . $this->fakeRawHeader;
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn($rawHeader . $this->fakeRawBody);

        $this->client->sendRequest();
        list($rawHeaders, $rawBody) = $this->client->extractResponseHeadersAndBody();

        $this->assertEquals($rawHeaders, trim($rawHeader));
        $this->assertEquals($rawBody, $this->fakeRawBody);
    }

    /**
     * @throws SamedaySDKException
     */
    public function testCanSendNormalRequest()
    {
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('setoptArray')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn($this->fakeRawHeader . $this->fakeRawBody);
        $this->curl
            ->expects($this->once())
            ->method('errno')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('close')
            ->willReturn(null);

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
        $this->expectException(SamedaySDKException::class);
        $this->setUpRequirements();
        $this->curl
            ->expects($this->once())
            ->method('init')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('setoptArray')
            ->willReturn(null);
        $this->curl
            ->expects($this->once())
            ->method('exec')
            ->willReturn(false);
        $this->curl
            ->expects($this->once())
            ->method('errno')
            ->willReturn(123);
        $this->curl
            ->expects($this->once())
            ->method('error')
            ->willReturn('Foo error');

        $this->client->send('http://foo.com/', 'GET', '', [], 60);
    }
}

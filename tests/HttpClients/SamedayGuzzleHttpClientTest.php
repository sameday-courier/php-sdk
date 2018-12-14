<?php

namespace Sameday\Tests\HttpClients;

use Mockery\MockInterface;
use Sameday\HttpClients\SamedayGuzzleHttpClient;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Exception\RequestException;

class SamedayGuzzleHttpClientTest extends AbstractTestHttpClient
{
    /**
     * @var MockInterface|\GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @var SamedayGuzzleHttpClient
     */
    protected $client;

    protected function setUp()
    {
        $this->guzzle = \Mockery::mock('GuzzleHttp\Client');
        $this->client = new SamedayGuzzleHttpClient($this->guzzle);
    }

    public function testCanSendNormalRequest()
    {
        $request = new Request('GET', 'http://foo.com');

        $body = Stream::factory($this->fakeRawBody);
        $response = new Response(200, $this->fakeHeadersAsArray, $body);

        $this->guzzle
            ->shouldReceive('createRequest')
            ->once()
            ->with('GET', 'http://foo.com/', \Mockery::on(function ($arg) {
                // array_diff_assoc() will sometimes trigger error on child-arrays
                if (['X-foo' => 'bar'] !== $arg['headers']) {
                    return false;
                }
                unset($arg['headers']);

                $diff = array_diff_assoc($arg, [
                    'body' => 'foo_body',
                    'timeout' => 123,
                    'connect_timeout' => 10,
                ]);

                return count($diff) === 0;
            }))
            ->andReturn($request);
        $this->guzzle
            ->shouldReceive('send')
            ->once()
            ->with($request)
            ->andReturn($response);

        $response = $this->client->send('http://foo.com/', 'GET', 'foo_body', ['X-foo' => 'bar'], 123);

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
        $request = new Request('GET', 'http://foo.com');

        $this->guzzle
            ->shouldReceive('createRequest')
            ->once()
            ->with('GET', 'http://foo.com/', \Mockery::on(function ($arg) {
                // array_diff_assoc() will sometimes trigger error on child-arrays
                if ([] !== $arg['headers']) {
                    return false;
                }
                unset($arg['headers']);

                $diff = array_diff_assoc($arg, [
                    'body' => 'foo_body',
                    'timeout' => 60,
                    'connect_timeout' => 10,
                ]);

                return count($diff) === 0;
            }))
            ->andReturn($request);
        $this->guzzle
            ->shouldReceive('send')
            ->once()
            ->with($request)
            ->andThrow(new RequestException('Foo', $request));

        $this->client->send('http://foo.com/', 'GET', 'foo_body', [], 60);
    }
}

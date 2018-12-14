<?php

namespace Sameday\Tests\HttpClients;

use Mockery\MockInterface;
use Sameday\HttpClients\SamedayStreamHttpClient;

class SamedayStreamHttpClientTest extends AbstractTestHttpClient
{
    /**
     * @var MockInterface|\Sameday\HttpClients\SamedayStream
     */
    protected $stream;

    /**
     * @var SamedayStreamHttpClient
     */
    protected $client;

    protected function setUp()
    {
        $this->stream = \Mockery::mock('Sameday\HttpClients\SamedayStream');
        $this->client = new SamedayStreamHttpClient($this->stream);
    }

    public function testCanCompileHeader()
    {
        $headers = [
            'X-foo' => 'bar',
            'X-bar' => 'faz',
        ];

        $header = $this->client->compileHeader($headers);
        $this->assertEquals("X-foo: bar\r\nX-bar: faz", $header);
    }

    public function testCanSendNormalRequest()
    {
        $this->stream
            ->shouldReceive('streamContextCreate')
            ->once()
            ->with(\Mockery::on(function ($arg) {
                if (!isset($arg['http'], $arg['ssl'])) {
                    return false;
                }

                if ($arg['http'] !== [
                        'method' => 'GET',
                        'header' => 'X-foo: bar',
                        'content' => 'foo_body',
                        'timeout' => 123,
                        'ignore_errors' => true,
                    ]
                ) {
                    return false;
                }

                $diff = array_diff_assoc($arg['ssl'], [
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                    'allow_self_signed' => true,
                ]);

                return count($diff) === 0;
            }))
            ->andReturn(null);
        $this->stream
            ->shouldReceive('getResponseHeaders')
            ->once()
            ->andReturn(explode("\n", trim($this->fakeRawHeader)));
        $this->stream
            ->shouldReceive('fileGetContents')
            ->once()
            ->with('http://foo.com/')
            ->andReturn($this->fakeRawBody);

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
        $this->stream
            ->shouldReceive('streamContextCreate')
            ->once()
            ->andReturn(null);
        $this->stream
            ->shouldReceive('getResponseHeaders')
            ->once()
            ->andReturn(null);
        $this->stream
            ->shouldReceive('fileGetContents')
            ->once()
            ->with('http://foo.com/')
            ->andReturn(false);

        $this->client->send('http://foo.com/', 'GET', 'foo_body', [], 60);
    }
}

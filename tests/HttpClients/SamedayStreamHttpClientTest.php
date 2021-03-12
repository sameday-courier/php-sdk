<?php

namespace Sameday\Tests\HttpClients;

use Sameday\Exceptions\SamedaySDKException;
use Sameday\HttpClients\SamedayStreamHttpClient;

class SamedayStreamHttpClientTest extends AbstractTestHttpClient
{
    /**
     * @var \Sameday\HttpClients\SamedayStream
     */
    protected $stream;

    /**
     * @var SamedayStreamHttpClient
     */
    protected $client;

    private function setUpRequirements()
    {
        $this->stream = $this->createMock('Sameday\HttpClients\SamedayStream');
        $this->client = new SamedayStreamHttpClient($this->stream);
    }

    public function testCanCompileHeader()
    {
        $this->setUpRequirements();

        $headers = [
            'X-foo' => 'bar',
            'X-bar' => 'faz',
        ];

        $header = $this->client->compileHeader($headers);
        $this->assertEquals("X-foo: bar\r\nX-bar: faz", $header);
    }

    /**
     * @throws SamedaySDKException
     */
    public function testCanSendNormalRequest()
    {
        $this->setUpRequirements();
        $this->stream
            ->expects($this->once())
            ->method('streamContextCreate')
            ->with($this->callback(function ($arg) {
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
            ->willReturn(null);
        $this->stream
            ->expects($this->once())
            ->method('getResponseHeaders')
            ->willReturn(explode("\n", trim($this->fakeRawHeader)));
        $this->stream
            ->expects($this->once())
            ->method('fileGetContents')
            ->with('http://foo.com/')
            ->willReturn($this->fakeRawBody);

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
        $this->expectException(SamedaySDKException::class);
        $this->setUpRequirements();
        $this->stream
            ->expects($this->once())
            ->method('streamContextCreate')
            ->willReturn(null);
        $this->stream
            ->expects($this->once())
            ->method('getResponseHeaders')
            ->willReturn(null);
        $this->stream
            ->expects($this->once())
            ->method('fileGetContents')
            ->with('http://foo.com/')
            ->willReturn(false);

        $this->client->send('http://foo.com/', 'GET', 'foo_body', [], 60);
    }
}

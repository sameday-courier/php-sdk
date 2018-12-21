<?php

namespace Sameday\Tests;

use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Sameday\PersistentData\SamedayMemoryPersistentDataHandler;
use Sameday\SamedayClient;

class SamedayClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testAddAuthToken()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->with(
                'https://foo.com/endpoint',
                'GET',
                '',
                [
                    'X-AUTH-TOKEN' => 'foo',
                    'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                ]
            )
            ->willReturn(new SamedayRawResponse([], '', 200));

        $persistentDataHandler = new SamedayMemoryPersistentDataHandler();
        $persistentDataHandler->set('token', 'foo');
        $persistentDataHandler->set('expires_at', (new \DateTime('+1 day'))->format('Y-m-d H:i:s'));

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, $persistentDataHandler);
        $client->sendRequest(new SamedayRequest(
            true,
            'GET',
            '/endpoint'
        ));
    }

    public function testAddPlatformHeader()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->with(
                'https://foo.com/endpoint',
                'GET',
                '',
                [
                    'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                    'X-Platform' => 'foo/bar',
                ]
            )
            ->willReturn(new SamedayRawResponse([], '', 200));

        $client = new SamedayClient('username', 'password', 'https://foo.com', 'foo', 'bar', $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function testAddQueryString()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->exactly(2))
            ->method('send')
            ->withConsecutive(
                [
                    'https://foo.com/endpoint?bar=baz',
                    'GET',
                ],
                [
                    'https://foo.com/endpoint',
                    'GET',
                ]
            )
            ->willReturn(new SamedayRawResponse([], '', 200));

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());

        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint',
            [
                'foo' => null,
                'bar' => 'baz',
            ]
        ));

        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint',
            [
                'foo' => null,
                'bar' => null,
            ]
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function testRawResult()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], 'body', 200));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $response = $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));

        $this->assertEquals('body', $response->getBody());
        $this->assertEquals(200, $response->getHttpStatusCode());
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayServerException
     */
    public function testThrowsServerException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 500));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }


    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayAuthorizationException
     */
    public function testThrowsAuthorizationException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 401));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayAuthenticationException
     */
    public function testThrowsAuthenticationException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 403));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayBadRequestException
     */
    public function testThrowsBadRequestException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 400));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayNotFoundException
     */
    public function testThrowsNotFoundException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 404));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @expectedException \Sameday\Exceptions\SamedayOtherException
     */
    public function testThrowsOtherException()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 300));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $client->sendRequest(new SamedayRequest(
            false,
            'GET',
            '/endpoint'
        ));
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testAuthBeforeRequest()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->exactly(2))
            ->method('send')
            ->withConsecutive(
                [
                    'https://foo.com/api/authenticate',
                    'POST',
                ],
                [
                    'https://foo.com/endpoint',
                    'GET',
                    '',
                    [
                        'X-AUTH-TOKEN' => 'foo',
                        'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                    ],
                ]
            )
            ->willReturnOnConsecutiveCalls(
                new SamedayRawResponse([], '{"token":"foo","expire_at":"'. (new \DateTime('+1 day'))->format('Y-m-d H:i') .'"}', 200),
                new SamedayRawResponse([], 'body', 200)
            );

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $response = $client->sendRequest(new SamedayRequest(
            true,
            'GET',
            '/endpoint'
        ));

        $this->assertEquals('body', $response->getBody());
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testRetryInvalidAuth()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->exactly(3))
            ->method('send')
            ->withConsecutive(
                [
                    'https://foo.com/endpoint',
                    'GET',
                    '',
                    [
                        'X-AUTH-TOKEN' => 'foo',
                        'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                    ],
                ],
                [
                    'https://foo.com/api/authenticate',
                    'POST',
                ],
                [
                    'https://foo.com/endpoint',
                    'GET',
                    '',
                    [
                        'X-AUTH-TOKEN' => 'bar',
                        'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                    ],
                ]
            )
            ->willReturnOnConsecutiveCalls(
                new SamedayRawResponse([], 'foo_body', 401),
                new SamedayRawResponse([], '{"token":"bar","expire_at":"'. (new \DateTime('+1 day'))->format('Y-m-d H:i') .'"}', 200),
                new SamedayRawResponse([], 'bar_body', 200)
            );

        $persistentDataHandler = new SamedayMemoryPersistentDataHandler();
        $persistentDataHandler->set('token', 'foo');
        $persistentDataHandler->set('expires_at', (new \DateTime('+1 day'))->format('Y-m-d H:i:s'));

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, $persistentDataHandler);
        $response = $client->sendRequest(new SamedayRequest(
            true,
            'GET',
            '/endpoint'
        ));

        $this->assertEquals('bar_body', $response->getBody());
    }

    /**
     * @throws \Sameday\Exceptions\SamedayAuthenticationException
     * @throws \Sameday\Exceptions\SamedayAuthorizationException
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testRetryExpiredAuth()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->exactly(2))
            ->method('send')
            ->withConsecutive(
                [
                    'https://foo.com/api/authenticate',
                    'POST',
                ],
                [
                    'https://foo.com/endpoint',
                    'GET',
                    '',
                    [
                        'X-AUTH-TOKEN' => 'bar',
                        'User-Agent' => 'PHP-SDK/' . SamedayClient::VERSION,
                    ],
                ]
            )
            ->willReturnOnConsecutiveCalls(
                new SamedayRawResponse([], '{"token":"bar","expire_at":"'. (new \DateTime('+1 day'))->format('Y-m-d H:i') .'"}', 200),
                new SamedayRawResponse([], 'bar_body', 200)
            );

        $persistentDataHandler = new SamedayMemoryPersistentDataHandler();
        $persistentDataHandler->set('token', 'foo');
        $persistentDataHandler->set('expires_at', (new \DateTime('-1 day'))->format('Y-m-d H:i:s'));

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, $persistentDataHandler);
        $response = $client->sendRequest(new SamedayRequest(
            true,
            'GET',
            '/endpoint'
        ));

        $this->assertEquals('bar_body', $response->getBody());
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testLoginValid()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->with(
                'https://foo.com/api/authenticate',
                'POST'
            )
            ->willReturn(new SamedayRawResponse([], '{"token":"bar","expire_at":"'. (new \DateTime('+1 day'))->format('Y-m-d H:i') .'"}', 200));

        $persistentDataHandler = \Mockery::mock('Sameday\PersistentData\SamedayPersistentDataInterface');
        $persistentDataHandler->shouldNotReceive('get');
        $persistentDataHandler->shouldNotReceive('set');

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, $persistentDataHandler);
        $this->assertTrue($client->login());
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testLoginInvalid()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->once())
            ->method('send')
            ->willReturn(new SamedayRawResponse([], '', 403));

        $client = new SamedayClient('username', 'password', 'https://foo.com', null, null, $httpClientHandler, new SamedayMemoryPersistentDataHandler());
        $this->assertFalse($client->login());
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     * @throws \Exception
     */
    public function testLogout()
    {
        $httpClientHandler = $this->getMock('Sameday\HttpClients\SamedayHttpClientInterface');
        $httpClientHandler
            ->expects($this->never())
            ->method('send');

        $persistentDataHandler = new SamedayMemoryPersistentDataHandler();
        $persistentDataHandler->set('token', 'foo');
        $persistentDataHandler->set('expires_at', (new \DateTime('+1 day'))->format('Y-m-d H:i:s'));

        $client = new SamedayClient('username', 'password', null, null, null, $httpClientHandler, $persistentDataHandler);
        $client->logout();

        $this->assertNull($persistentDataHandler->get('token'));
        $this->assertNull($persistentDataHandler->get('expires_at'));
    }
}

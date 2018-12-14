<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayAuthenticateRequest;
use Sameday\Responses\SamedayAuthenticateResponse;

class SamedayAuthenticateResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayAuthenticateRequest('username', 'password');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayAuthenticateResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayAuthenticateRequest('username', 'password');
        $rawResponse = new SamedayRawResponse([], '{"token":"foo","expire_at":"2010-01-02 12:23"}', 200);
        $response = new SamedayAuthenticateResponse($request, $rawResponse);

        $this->assertEquals('foo', $response->getToken());
        $this->assertEquals('2010-01-02 12:23:00', $response->getExpiresAt()->format('Y-m-d H:i:s'));
    }
}

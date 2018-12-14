<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayAuthenticateRequest;

class SamedayAuthenticateRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildRequest()
    {
        $request = new SamedayAuthenticateRequest('username', 'password');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertFalse($samedayRequest->isNeedAuth());
        $this->assertEquals('POST', $samedayRequest->getMethod());
        $this->assertEquals('/api/authenticate', $samedayRequest->getEndpoint());
        $this->assertInstanceOf('Sameday\Http\RequestBodyUrlEncoded', $samedayRequest->getBody());
        $this->assertEquals('remember_me=1', $samedayRequest->getBody()->getBody());
        $this->assertEquals(
            [
                'X-Auth-Username' => 'username',
                'X-Auth-Password' => 'password',
            ],
            $samedayRequest->getHeaders()
        );
    }
}

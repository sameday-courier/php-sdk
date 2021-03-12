<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayDeleteAwbResponse;

class SamedayDeleteAwbResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayDeleteAwbRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayDeleteAwbResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

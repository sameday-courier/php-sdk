<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Responses\SamedayPutParcelSizeResponse;

class SamedayPutParcelSizeResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayPutParcelSizeRequest');
        $rawResponse = $this->createMock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPutParcelSizeResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

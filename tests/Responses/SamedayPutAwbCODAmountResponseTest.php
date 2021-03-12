<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Responses\SamedayPutAwbCODAmountResponse;

class SamedayPutAwbCODAmountResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayPutAwbCODAmountRequest');
        $rawResponse = $this->createMock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPutAwbCODAmountResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

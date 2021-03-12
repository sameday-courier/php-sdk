<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayPostAwbEstimationResponse;

class SamedayPostAwbEstimationResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayPostAwbEstimationRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayPostAwbEstimationResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = $this->createMock('Sameday\Requests\SamedayPostAwbEstimationRequest');
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "amount": 12.34,
    "currency": "foo",
    "time": 48
}
JSON
            , 201);
        $response = new SamedayPostAwbEstimationResponse($request, $rawResponse);

        $this->assertEquals(12.34, $response->getCost());
        $this->assertEquals('foo', $response->getCurrency());
        $this->assertEquals(48, $response->getTime());
    }
}

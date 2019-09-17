<?php

namespace Sameday\Tests\Responses;

use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayPostAwbResponse;

class SamedayPostAwbResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayPostAwbRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayPostAwbResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayPostAwbRequest');
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "awbNumber": "foo",
    "awbCost": 12.34,
    "parcels": [
        {
            "position": 1,
            "awbNumber": "parcel_foo"
        },
        {
            "position": 2,
            "awbNumber": "parcel_bar"
        }
    ],
    "pdfLink": "https://foo.com/awb"
}
JSON
            , 201);
        $response = new SamedayPostAwbResponse($request, $rawResponse);

        $this->assertEquals('foo', $response->getAwbNumber());
        $this->assertEquals(12.34, $response->getCost());
        $this->assertCount(2, $response->getParcels());
        $this->assertEquals(1, $response->getParcels()[0]->getPosition());
        $this->assertEquals('parcel_foo', $response->getParcels()[0]->getAwbNumber());
        $this->assertEquals(2, $response->getParcels()[1]->getPosition());
        $this->assertEquals('parcel_bar', $response->getParcels()[1]->getAwbNumber());
    }
}

<?php

namespace Sameday\Tests\Responses;

use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Responses\SamedayPutAwbCODAmountResponse;

class SamedayPutAwbCODAmountResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayPutAwbCODAmountRequest');
        $rawResponse = Mockery::mock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPutAwbCODAmountResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

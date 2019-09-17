<?php

namespace Sameday\Tests\Responses;

use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Responses\SamedayPutParcelSizeResponse;

class SamedayPutParcelSizeResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayPutParcelSizeRequest');
        $rawResponse = Mockery::mock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPutParcelSizeResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

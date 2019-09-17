<?php

namespace Sameday\Tests\Responses;

use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayDeleteAwbResponse;

class SamedayDeleteAwbResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayDeleteAwbRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayDeleteAwbResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

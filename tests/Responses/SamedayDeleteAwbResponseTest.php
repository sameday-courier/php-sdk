<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayDeleteAwbRequest;
use Sameday\Requests\SamedayPutParcelSizeRequest;
use Sameday\Responses\SamedayDeleteAwbResponse;
use Sameday\Responses\SamedayPutParcelSizeResponse;

class SamedayDeleteAwbResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayDeleteAwbRequest('foo');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayDeleteAwbResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

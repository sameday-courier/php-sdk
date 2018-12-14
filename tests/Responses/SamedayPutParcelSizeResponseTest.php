<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPutParcelSizeRequest;
use Sameday\Responses\SamedayPutParcelSizeResponse;

class SamedayPutParcelSizeResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayPutParcelSizeRequest('foo', 1, 1.1, 1.2, 1.3);
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayPutParcelSizeResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

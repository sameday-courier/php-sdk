<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayDeleteAwbResponse;
use Sameday\Responses\SamedayDeletePickupPointResponse;

class SamedayDeletePickupPointResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayDeletePickupPointRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayDeletePickupPointResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

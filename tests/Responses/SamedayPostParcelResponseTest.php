<?php

namespace Sameday\Tests\Responses;

use Sameday\Responses\SamedayPostParcelResponse;

class SamedayPostParcelResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->getMockBuilder('Sameday\Requests\SamedayPostParcelRequest')
            ->disableOriginalConstructor()
            ->getMock();
        $rawResponse = $this->getMockBuilder('Sameday\Http\SamedayRawResponse')
            ->disableOriginalConstructor()
            ->getMock();
        $response = new SamedayPostParcelResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }
}

<?php

namespace Sameday\Tests\Responses;

use Sameday\Responses\SamedayPostParcelResponse;

class SamedayPostParcelResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = \Mockery::mock('Sameday\Requests\SamedayPostParcelRequest');
        $rawResponse = \Mockery::mock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPostParcelResponse($request, $rawResponse, 'foo');

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
        $this->assertEquals('foo', $response->getParcelAwbNumber());
    }
}

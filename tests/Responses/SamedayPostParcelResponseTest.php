<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Responses\SamedayPostParcelResponse;

class SamedayPostParcelResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayPostParcelRequest');
        $rawResponse = $this->createMock('Sameday\Http\SamedayRawResponse');
        $response = new SamedayPostParcelResponse($request, $rawResponse, 'foo');

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
        $this->assertEquals('foo', $response->getParcelAwbNumber());
    }
}

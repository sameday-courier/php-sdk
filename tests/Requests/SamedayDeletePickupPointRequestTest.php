<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayDeleteAwbRequest;
use Sameday\Requests\SamedayDeletePickupPointRequest;

class SamedayDeletePickupPointRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayDeletePickupPointRequest(123);

        $this->assertEquals(123, $request->getPickupPointId());
    }

    public function testSetGet()
    {
        $request = new SamedayDeletePickupPointRequest(123);
        $request->setPickupPointId(123);

        $this->assertEquals(123, $request->getPickupPointId());
    }

    public function testBuildRequest()
    {
        $request = new SamedayDeletePickupPointRequest(123);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('DELETE', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/pickup-points/123', $samedayRequest->getEndpoint());
    }
}

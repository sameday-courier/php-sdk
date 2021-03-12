<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetPickupPointsRequest;

class SamedayGetPickupPointsRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetPickupPointsRequest();

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(50, $request->getCountPerPage());
    }

    public function testSetGet()
    {
        $request = new SamedayGetPickupPointsRequest();
        $request->setPage(2);
        $request->setCountPerPage(10);

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetPickupPointsRequest();
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/pickup-points', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 1, 'countPerPage' => 50], $samedayRequest->getQueryParams());
    }
}

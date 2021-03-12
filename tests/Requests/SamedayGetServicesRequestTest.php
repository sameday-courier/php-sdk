<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetServicesRequest;

class SamedayGetServicesRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetServicesRequest();

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(50, $request->getCountPerPage());
    }

    public function testSetGet()
    {
        $request = new SamedayGetServicesRequest();
        $request->setPage(2);
        $request->setCountPerPage(10);

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetServicesRequest();
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/services', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 1, 'countPerPage' => 50], $samedayRequest->getQueryParams());
    }
}

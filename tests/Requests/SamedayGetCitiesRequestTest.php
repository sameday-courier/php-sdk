<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetCitiesRequest;

class SamedayGetCitiesRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetCitiesRequest(1, 'foo', 'bar');

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(50, $request->getCountPerPage());
        $this->assertEquals(1, $request->getCountyId());
        $this->assertEquals('foo', $request->getName());
        $this->assertEquals('bar', $request->getPostalCode());
    }

    public function testSetGet()
    {
        $request = new SamedayGetCitiesRequest();
        $request->setPage(2);
        $request->setCountPerPage(10);
        $request->setCountyId(2);
        $request->setName('bar');
        $request->setPostalCode('foo');

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
        $this->assertEquals(2, $request->getCountyId());
        $this->assertEquals('bar', $request->getName());
        $this->assertEquals('foo', $request->getPostalCode());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetCitiesRequest(3, 'foo');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/geolocation/city', $samedayRequest->getEndpoint());
        $this->assertEquals([
            'page' => 1,
            'countPerPage' => 50,
            'county' => 3,
            'name' => 'foo',
            'postalCode' => null,
        ], $samedayRequest->getQueryParams());
    }
}

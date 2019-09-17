<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayGetCitiesRequest;

class SamedayGetCitiesRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetCitiesRequest();

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(50, $request->getCountPerPage());
        $this->assertEquals(null, $request->getName());
    }

    public function testSetGet()
    {
        $request = new SamedayGetCitiesRequest();
        $request->setPage(2);
        $request->setCountPerPage(10);
        $request->setName('bar');

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
        $this->assertEquals('bar', $request->getName());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetCitiesRequest();
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/geolocation/city', $samedayRequest->getEndpoint());
        $this->assertEquals([
                'page' => 1,
                'countPerPage' => 50,
                'name' => null,
                'county' => null,
                'postalCode' => null
        ], $samedayRequest->getQueryParams());
    }
}

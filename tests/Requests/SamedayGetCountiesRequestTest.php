<?php

namespace Sameday\Tests\Requests;

use PHPUnit_Framework_TestCase;
use Sameday\Requests\SamedayGetCountiesRequest;

class SamedayGetCountiesRequestTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetCountiesRequest('foo');

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(50, $request->getCountPerPage());
        $this->assertEquals('foo', $request->getName());
    }

    public function testSetGet()
    {
        $request = new SamedayGetCountiesRequest('foo');
        $request->setPage(2);
        $request->setCountPerPage(10);
        $request->setName('bar');

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
        $this->assertEquals('bar', $request->getName());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetCountiesRequest('foo');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/geolocation/county', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 1, 'countPerPage' => 50, 'name' => 'foo'], $samedayRequest->getQueryParams());
    }
}

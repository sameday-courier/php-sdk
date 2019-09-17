<?php

namespace Sameday\Tests\Requests;

use PHPUnit_Framework_TestCase;
use Sameday\Requests\SamedayPutParcelSizeRequest;

class SamedayPutParcelSizeRequestTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = new SamedayPutParcelSizeRequest('foo', 1, 1.1, 1.2, 1.3);

        $this->assertEquals('foo', $request->getParcel());
        $this->assertEquals(1, $request->getWeight());
        $this->assertEquals(1.1, $request->getWidth());
        $this->assertEquals(1.2, $request->getLength());
        $this->assertEquals(1.3, $request->getHeight());
    }

    public function testSetGet()
    {
        $request = new SamedayPutParcelSizeRequest('foo', 1, 1.1, 1.2, 1.3);
        $request->setParcel('bar');
        $request->setWeight(2);
        $request->setWidth(2.1);
        $request->setLength(2.2);
        $request->setHeight(2.3);

        $this->assertEquals('bar', $request->getParcel());
        $this->assertEquals(2, $request->getWeight());
        $this->assertEquals(2.1, $request->getWidth());
        $this->assertEquals(2.2, $request->getLength());
        $this->assertEquals(2.3, $request->getHeight());
    }

    public function testBuildRequest()
    {
        $request = new SamedayPutParcelSizeRequest('foo', 1, 1.1, 1.2, 1.3);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('PUT', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/parcel/foo/size', $samedayRequest->getEndpoint());
        $this->assertEquals('weight=1&width=1.1&length=1.2&height=1.3', $samedayRequest->getBody()->getBody());
    }
}

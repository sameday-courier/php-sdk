<?php

namespace Sameday\Tests\Requests;

use PHPUnit_Framework_TestCase;
use Sameday\Requests\SamedayGetParcelStatusHistoryRequest;

class SamedayGetParcelStatusHistoryRequestTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetParcelStatusHistoryRequest('foo');

        $this->assertEquals('foo', $request->getParcel());
    }

    public function testSetGet()
    {
        $request = new SamedayGetParcelStatusHistoryRequest('foo');
        $request->setParcel('bar');

        $this->assertEquals('bar', $request->getParcel());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetParcelStatusHistoryRequest('foo');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/parcel/foo/status-history', $samedayRequest->getEndpoint());
    }
}

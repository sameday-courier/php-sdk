<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetAwbStatusHistoryRequest;

class SamedayGetAwbStatusHistoryRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetAwbStatusHistoryRequest('foo');

        $this->assertEquals('foo', $request->getAwb());
    }

    public function testSetGet()
    {
        $request = new SamedayGetAwbStatusHistoryRequest('foo');
        $request->setAwb('bar');

        $this->assertEquals('bar', $request->getAwb());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetAwbStatusHistoryRequest('foo');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/awb/foo/status', $samedayRequest->getEndpoint());
    }
}

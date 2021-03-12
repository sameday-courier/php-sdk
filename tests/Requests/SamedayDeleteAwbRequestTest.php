<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayDeleteAwbRequest;

class SamedayDeleteAwbRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayDeleteAwbRequest('foo');

        $this->assertEquals('foo', $request->getAwb());
    }

    public function testSetGet()
    {
        $request = new SamedayDeleteAwbRequest('foo');
        $request->setAwb('bar');

        $this->assertEquals('bar', $request->getAwb());
    }

    public function testBuildRequest()
    {
        $request = new SamedayDeleteAwbRequest('foo');
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('DELETE', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb/foo', $samedayRequest->getEndpoint());
    }
}

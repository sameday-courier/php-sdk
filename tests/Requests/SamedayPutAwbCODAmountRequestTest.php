<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayPutAwbCODAmountRequest;

class SamedayPutAwbCODAmountRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayPutAwbCODAmountRequest('foo', 1.2);

        $this->assertEquals('foo', $request->getAwb());
        $this->assertEquals(1.2, $request->getCODAmount());
    }

    public function testSetGet()
    {
        $request = new SamedayPutAwbCODAmountRequest('foo', 1.2);
        $request->setAwb('bar');
        $request->setCODAmount(2.1);

        $this->assertEquals('bar', $request->getAwb());
        $this->assertEquals(2.1, $request->getCODAmount());
    }

    public function testBuildRequest()
    {
        $request = new SamedayPutAwbCODAmountRequest('foo', 1.2);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('PUT', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb/foo/update-cod', $samedayRequest->getEndpoint());
        $this->assertEquals('cashOnDelivery=1.2', $samedayRequest->getBody()->getBody());
    }
}

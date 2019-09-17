<?php

namespace Sameday\Tests\Requests;

use PHPUnit_Framework_TestCase;
use Sameday\Objects\Types\AwbPdfType;
use Sameday\Requests\SamedayGetAwbPdfRequest;

class SamedayGetAwbPdfRequestTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $awbType = new AwbPdfType('foo');
        $request = new SamedayGetAwbPdfRequest('foo', $awbType);

        $this->assertEquals('foo', $request->getAwbNumber());
        $this->assertEquals($awbType, $request->getAwbPdfType());
    }

    public function testSetGet()
    {
        $request = new SamedayGetAwbPdfRequest('foo', new AwbPdfType('foo_type'));
        $awbType = new AwbPdfType('bar_type');

        $request->setAwbNumber('bar');
        $request->setAwbPdfType($awbType);

        $this->assertEquals('bar', $request->getAwbNumber());
        $this->assertEquals($awbType, $request->getAwbPdfType());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetAwbPdfRequest('foo', new AwbPdfType('bar'));
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb/download/foo/bar', $samedayRequest->getEndpoint());
    }
}

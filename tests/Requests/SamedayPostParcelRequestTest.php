<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Objects\ParcelDimensionsObject;
use Sameday\Requests\SamedayPostParcelRequest;

class SamedayPostParcelRequestTest extends TestCase
{
    public function testConstructor()
    {
        $parcelDimensions = new ParcelDimensionsObject(1, 2, 3, 4);

        $request = new SamedayPostParcelRequest(
            'foo',
            $parcelDimensions,
            2,
            'observation',
            'priceObservation',
            true
        );

        $this->assertEquals('foo', $request->getAwbNumber());
        $this->assertEquals($parcelDimensions, $request->getParcelDimensions());
        $this->assertEquals(2, $request->getPosition());
        $this->assertEquals('observation', $request->getObservation());
        $this->assertEquals('priceObservation', $request->getPriceObservation());
        $this->assertTrue($request->isLast());
    }

    public function testSetGet()
    {
        $request = new SamedayPostParcelRequest(
            'foo',
            new ParcelDimensionsObject(1, 2, 3, 4),
            1,
            'foo_observation',
            'foo_priceObservation',
            true
        );

        $parcelDimensions = new ParcelDimensionsObject(4, 3, 2, 1);

        $request->setAwbNumber('bar');
        $request->setParcelDimensions($parcelDimensions);
        $request->setPosition(2);
        $request->setObservation('bar_observation');
        $request->setPriceObservation('bar_priceObservation');
        $request->setLast(false);

        $this->assertEquals('bar', $request->getAwbNumber());
        $this->assertEquals($parcelDimensions, $request->getParcelDimensions());
        $this->assertEquals(2, $request->getPosition());
        $this->assertEquals('bar_observation', $request->getObservation());
        $this->assertEquals('bar_priceObservation', $request->getPriceObservation());
        $this->assertFalse($request->isLast());
    }

    public function testBuildRequest()
    {
        $parcelDimensions = new ParcelDimensionsObject(1, 2, 3, 4);

        $request = new SamedayPostParcelRequest(
            'foo',
            $parcelDimensions,
            2,
            'observation',
            'priceObservation',
            true
        );
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('POST', $samedayRequest->getMethod());
        $this->assertEquals('/api/awb/foo/parcel', $samedayRequest->getEndpoint());
        $this->assertEquals('weight=1&width=2&length=3&height=4&position=2&isLast=1&observation=observation&priceObservation=priceObservation', $samedayRequest->getBody()->getBody());
    }
}

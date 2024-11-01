<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Objects\PickupPoint\PickupPointContactPersonObject;
use Sameday\Requests\SamedayPostPickupPointRequest;

class SamedayPostPickupPointRequestTest extends TestCase
{
    public function testConstructor()
    {
        $contactPersons[] = new PickupPointContactPersonObject(
            'John One',
            '0701234567',
            true
        );

        $contactPersons[] = new PickupPointContactPersonObject(
            'John Two',
            '0702345678',
            true
        );

        $pickupPointRequest = new SamedayPostPickupPointRequest(
            '187',
            '1',
            '1',
            'Address',
            '123',
            'Warehouse',
            $contactPersons,
            true
        );

        $this->assertEquals('187', $pickupPointRequest->getCountryId());
        $this->assertEquals('1', $pickupPointRequest->getCountyId());
        $this->assertEquals('1', $pickupPointRequest->getCityId());
        $this->assertEquals('Address', $pickupPointRequest->getAddress());
        $this->assertEquals('123', $pickupPointRequest->getPostalCode());
        $this->assertEquals('Warehouse', $pickupPointRequest->getAlias());
        $this->assertEquals($contactPersons, $pickupPointRequest->getContactPersons());
        $this->assertEquals($contactPersons[0]->getPhoneNumber(), $pickupPointRequest->getContactPersons()[0]->getPhoneNumber());
        $this->assertTrue($pickupPointRequest->isDefaultPickupPoint());
    }

    public function testBuildRequest()
    {
        $request = new SamedayPostPickupPointRequest(
            '187',
            '1',
            '1',
            'street 1',
            '012345',
            'Warehouse',
            [new PickupPointContactPersonObject('Test', '123', true)],
            true
        );

        $pickupPointRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $pickupPointRequest);
        $this->assertTrue($pickupPointRequest->isNeedAuth());
        $this->assertEquals('POST', $pickupPointRequest->getMethod());
        $this->assertEquals('/api/client/pickup-points', $pickupPointRequest->getEndpoint());
    }
}

<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Objects\ContactPersonObject;
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
            'Bucuresti',
            'Address',
            '123',
            'Warehouse',
            $contactPersons,
            true
        );

        $this->assertEquals('187', $pickupPointRequest->getCountryId());
        $this->assertEquals('1', $pickupPointRequest->getCountyId());
        $this->assertEquals('Bucuresti', $pickupPointRequest->getCityId());
        $this->assertEquals('Address', $pickupPointRequest->getAddress());
        $this->assertEquals('123', $pickupPointRequest->getPostalCode());
        $this->assertEquals('Warehouse', $pickupPointRequest->getAlias());
        $this->assertEquals($contactPersons, $pickupPointRequest->getContactPersons());
        $this->assertTrue($pickupPointRequest->isDefaultPickupPoint());
    }
}

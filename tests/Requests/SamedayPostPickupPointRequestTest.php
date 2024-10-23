<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Objects\PickupPoint\ContactPersonObject;
use Sameday\Requests\SamedayPostPickupPointRequest;

class SamedayPostPickupPointRequestTest extends TestCase
{
    public function testConstructor()
    {
        $contactPersons[] = new ContactPersonObject(
            123,
            'Person One',
            '123',
            true
        );

        $contactPersons[] = new ContactPersonObject(
            123,
            'Person Two',
            '123',
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
        $this->assertEquals('Bucuresti', $pickupPointRequest->getCity());
        $this->assertEquals('Address', $pickupPointRequest->getAddress());
        $this->assertEquals('123', $pickupPointRequest->getPostalCode());
        $this->assertEquals('Warehouse', $pickupPointRequest->getAlias());
        $this->assertEquals($contactPersons, $pickupPointRequest->getContactPersons());
        $this->assertTrue($pickupPointRequest->isDefaultPickupPoint());
    }
}

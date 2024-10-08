<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Objects\CountryObject;
use Sameday\Objects\CountyObject;
use Sameday\Objects\PickupPoint\CityObject;
use Sameday\Objects\PickupPoint\ContactPersonObject;
use Sameday\Objects\PickupPoint\PickupPointObject;
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
            new PickupPointObject(
                123,
                new CountryObject(
                    187,
                    'Romania',
                    'RO'
                ),
                new CountyObject(
                    '',
                    '',
                    ''
                ),
                new CityObject(
                    11,
                    '',
                    '',
                    '',
                    ''
                ),
                'Test address',
                1,
                $contactPersons,
                'My Warehouse',
                '014123'
            )
        );

        $this->assertEquals('123', $pickupPointRequest->pickupPoint->getId());
        $this->assertEquals('RO', $pickupPointRequest->pickupPoint->getCountry()->getCode());
        $this->assertEquals('Romania', $pickupPointRequest->pickupPoint->getCountry()->getName());
        $this->assertEquals($contactPersons, $pickupPointRequest->pickupPoint->getContactPersons());
    }
}

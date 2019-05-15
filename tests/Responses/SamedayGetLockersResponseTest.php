<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Locker\BoxObject;
use Sameday\Objects\Locker\LockerObject;
use Sameday\Objects\Locker\ScheduleObject;
use Sameday\Objects\Service\DeliveryTypeObject;
use Sameday\Objects\Service\OptionalTaxObject;
use Sameday\Objects\Service\ServiceObject;
use Sameday\Objects\Types\CostType;
use Sameday\Objects\Types\PackageType;
use Sameday\Requests\SamedayGetLockersRequest;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayGetLockersResponse;
use Sameday\Responses\SamedayGetServicesResponse;

class SamedayGetLockersResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetLockersRequest();
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetLockersResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetLockersRequest();
        $rawResponse = new SamedayRawResponse([], <<<JSON
[
    {
        "name": "Belu",
        "county": "Bucuresti",
        "city": "Sectorul 4",
        "address": "SOS. OLTENITEI NR. 2",
        "postalCode": "445010",
        "lat": "44.402301",
        "lng": "26.098118",
        "phone": "1234567890",
        "email": "foo@bar.com",
        "availableBoxes": [
            {
                "size": "S",
                "number": 15
            },
            {
                "size": "M",
                "number": 9
            },
            {
                "size": "L",
                "number": 3
            }
        ],
        "lockerId": 2,
        "schedule": [
            {
                "day": 1,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 2,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 3,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 4,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 5,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 6,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 7,
                "openingHour": "00:00",
                "closingHour": "23:59"
            }
        ]
    },
    {
        "name": "Berceni",
        "county": "Bucuresti",
        "city": "Sectorul 4",
        "address": "STR. BERCENI NR. 8",
        "postalCode": "45006",
        "lat": "44.389929",
        "lng": "26.124641",
        "phone": "0987654321",
        "email": "bar@foo.com",
        "availableBoxes": [
            {
                "size": "S",
                "number": 20
            },
            {
                "size": "M",
                "number": 14
            },
            {
                "size": "L",
                "number": 2
            }
        ],
        "lockerId": 1,
        "schedule": [
            {
                "day": 1,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 2,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 3,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 4,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 5,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 6,
                "openingHour": "00:00",
                "closingHour": "23:59"
            },
            {
                "day": 7,
                "openingHour": "00:00",
                "closingHour": "23:59"
            }
        ]
    }
]
JSON
            , 200);
        $response = new SamedayGetLockersResponse($request, $rawResponse);

        $lockers = $response->getLockers();
        $this->assertCount(2, $lockers);

        $this->assertEquals(
            new LockerObject(
                2,
                'Belu',
                'Bucuresti',
                'Sectorul 4',
                'SOS. OLTENITEI NR. 2',
                '445010',
                '44.402301',
                '26.098118',
                '1234567890',
                'foo@bar.com',
                [
                    new BoxObject('S', 15),
                    new BoxObject('M', 9),
                    new BoxObject('L', 3)
                ],
                [
                    new ScheduleObject(1, '00:00', '23:59'),
                    new ScheduleObject(2, '00:00', '23:59'),
                    new ScheduleObject(3, '00:00', '23:59'),
                    new ScheduleObject(4, '00:00', '23:59'),
                    new ScheduleObject(5, '00:00', '23:59'),
                    new ScheduleObject(6, '00:00', '23:59'),
                    new ScheduleObject(7, '00:00', '23:59'),
                ]
            ),
            $lockers[0]
        );

        $this->assertEquals(
            new LockerObject(
                1,
                'Berceni',
                'Bucuresti',
                'Sectorul 4',
                'STR. BERCENI NR. 8',
                '45006',
                '44.389929',
                '26.124641',
                '0987654321',
                'bar@foo.com',
                [
                    new BoxObject('S', 20),
                    new BoxObject('M', 14),
                    new BoxObject('L', 2)
                ],
                [
                    new ScheduleObject(1, '00:00', '23:59'),
                    new ScheduleObject(2, '00:00', '23:59'),
                    new ScheduleObject(3, '00:00', '23:59'),
                    new ScheduleObject(4, '00:00', '23:59'),
                    new ScheduleObject(5, '00:00', '23:59'),
                    new ScheduleObject(6, '00:00', '23:59'),
                    new ScheduleObject(7, '00:00', '23:59'),
                ]
            ),
            $lockers[1]
        );
    }
}

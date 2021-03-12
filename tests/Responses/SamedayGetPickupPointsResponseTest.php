<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\CountyObject;
use Sameday\Objects\PickupPoint\CityObject;
use Sameday\Objects\PickupPoint\ContactPersonObject;
use Sameday\Objects\PickupPoint\PickupPointObject;
use Sameday\Requests\SamedayGetPickupPointsRequest;
use Sameday\Responses\SamedayGetPickupPointsResponse;

class SamedayGetPickupPointsResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetPickupPointsRequest();
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetPickupPointsResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetPickupPointsRequest();
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "total": 1,
    "currentPage":2,
    "pages": 3,
    "perPage": 4,
    "data": [
        {
            "id": 139,
            "county": {
                "id": 1,
                "name": "Bucuresti",
                "code": "B"
            },
            "city": {
                "samedayDeliveryAgency": "B_SEMA_A03",
                "samedayPickupAgency": "B_SEMA_A03",
                "id": 6,
                "name": "Sectorul 6",
                "extraKM": 0
            },
            "address": "Splaiul Independentei 319, OB17C",
            "defaultPickupPoint": true,
            "pickupPointContactPerson": [
                {
                    "id": 145,
                    "name": "Software",
                    "phoneNumber": "021.637.06.60",
                    "defaultContactPerson": true
                },
                {
                    "id": 146,
                    "name": "Software2",
                    "phoneNumber": "021.637.06.600",
                    "defaultContactPerson": false
                }
            ],
            "alias": "Software",
            "status": true
        },
        {
            "id": 1641,
            "county": {
                "id": 1,
                "name": "Bucuresti",
                "code": "B"
            },
            "city": {
                "samedayDeliveryAgency": "B_SEMA_A03",
                "samedayPickupAgency": "B_SEMA_A03",
                "id": 6,
                "name": "Sectorul 6",
                "extraKM": 10
            },
            "address": "Splaiul Independentei 319, OB17C",
            "defaultPickupPoint": false,
            "pickupPointContactPerson": [
                {
                    "id": 1740,
                    "name": "Customer Care",
                    "phoneNumber": "021.637.06.60",
                    "defaultContactPerson": true
                }
            ],
            "alias": "Customer Care",
            "status": true
        }
    ]
}
JSON
            , 200);
        $response = new SamedayGetPickupPointsResponse($request, $rawResponse);

        $pickupPoints = $response->getPickupPoints();
        $this->assertCount(2, $pickupPoints);

        $this->assertEquals(1, $response->getTotal());
        $this->assertEquals(2, $response->getCurrentPage());
        $this->assertEquals(3, $response->getPages());
        $this->assertEquals(4, $response->getPerPage());

        $this->assertEquals(
            new PickupPointObject(
                139,
                new CountyObject(1, 'Bucuresti', 'B'),
                new CityObject(6, 'Sectorul 6', 'B_SEMA_A03', 'B_SEMA_A03', 0),
                'Splaiul Independentei 319, OB17C',
                true,
                [
                    new ContactPersonObject(145, 'Software', '021.637.06.60', true),
                    new ContactPersonObject(146, 'Software2', '021.637.06.600', false),
                ],
                'Software'
            ),
            $pickupPoints[0]
        );

        $this->assertEquals(
            new PickupPointObject(
                1641,
                new CountyObject(1, 'Bucuresti', 'B'),
                new CityObject(6, 'Sectorul 6', 'B_SEMA_A03', 'B_SEMA_A03', 10),
                'Splaiul Independentei 319, OB17C',
                false,
                [
                    new ContactPersonObject(1740, 'Customer Care', '021.637.06.60', true),
                ],
                'Customer Care'
            ),
            $pickupPoints[1]
        );
    }
}

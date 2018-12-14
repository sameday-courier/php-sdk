<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayGetPickupPointsRequest;
use Sameday\Responses\SamedayGetPickupPointsResponse;

class SamedayGetPickupPointsResponseTest extends \PHPUnit_Framework_TestCase
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

        $this->assertEquals(139, $pickupPoints[0]->getId());
        $this->assertEquals(1, $pickupPoints[0]->getCounty()->getId());
        $this->assertEquals('Bucuresti', $pickupPoints[0]->getCounty()->getName());
        $this->assertEquals('B', $pickupPoints[0]->getCounty()->getCode());
        $this->assertEquals('B_SEMA_A03', $pickupPoints[0]->getCity()->getDeliveryAgency());
        $this->assertEquals('B_SEMA_A03', $pickupPoints[0]->getCity()->getPickupAgency());
        $this->assertEquals(6, $pickupPoints[0]->getCity()->getId());
        $this->assertEquals('Sectorul 6', $pickupPoints[0]->getCity()->getName());
        $this->assertEquals(0, $pickupPoints[0]->getCity()->getExtraKm());
        $this->assertEquals('Splaiul Independentei 319, OB17C', $pickupPoints[0]->getAddress());
        $this->assertTrue($pickupPoints[0]->isDefault());
        $this->assertCount(2, $pickupPoints[0]->getContactPersons());
        $this->assertEquals(145, $pickupPoints[0]->getContactPersons()[0]->getId());
        $this->assertEquals('Software', $pickupPoints[0]->getContactPersons()[0]->getName());
        $this->assertEquals('021.637.06.60', $pickupPoints[0]->getContactPersons()[0]->getPhone());
        $this->assertTrue($pickupPoints[0]->getContactPersons()[0]->isDefault());
        $this->assertEquals(146, $pickupPoints[0]->getContactPersons()[1]->getId());
        $this->assertEquals('Software2', $pickupPoints[0]->getContactPersons()[1]->getName());
        $this->assertEquals('021.637.06.600', $pickupPoints[0]->getContactPersons()[1]->getPhone());
        $this->assertFalse($pickupPoints[0]->getContactPersons()[1]->isDefault());
        $this->assertEquals('Software', $pickupPoints[0]->getAlias());

        $this->assertEquals(10, $pickupPoints[1]->getCity()->getExtraKm());
        $this->assertFalse($pickupPoints[1]->isDefault());
    }
}

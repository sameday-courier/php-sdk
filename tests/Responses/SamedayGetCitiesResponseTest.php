<?php

namespace Sameday\Tests\Responses;

use PHPUnit_Framework_TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\CityObject;
use Sameday\Objects\CountyObject;
use Sameday\Requests\SamedayGetCitiesRequest;
use Sameday\Responses\SamedayGetCitiesResponse;

class SamedayGetCitiesResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetCitiesRequest();
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetCitiesResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetCitiesRequest();
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "total": 1,
    "currentPage": 2,
    "pages": 3,
    "perPage": 4,
    "data": [
        {
            "samedayDeliveryAgency": "B_SEMA_A03",
            "samedayPickupAgency": "B_SEMA_A03",
            "nextDayDeliveryAgency": "B_JILAVA_A02",
            "logisticCircle": "Cerc 1",
            "id": 7,
            "name": "1 Decembrie",
            "county": {
                "id": 26,
                "name": "Ilfov",
                "code": "IF"
            },
            "postalCode": "077005",
            "extraKM": 0,
            "village": "1 Decembrie"
        },
        {
            "samedayDeliveryAgency": "CT_CONSTANTA_A01",
            "samedayPickupAgency": "CT_CONSTANTA_A01",
            "nextDayDeliveryAgency": "CT_MANGALIA_A04",
            "logisticCircle": "Cerc 1",
            "id": 9438,
            "name": "2 Mai",
            "county": {
                "id": 15,
                "name": "Constanta",
                "code": "CT"
            },
            "postalCode": "907161",
            "extraKM": 1,
            "village": "Limanu"
        }
    ]
}
JSON
            , 200);
        $response = new SamedayGetCitiesResponse($request, $rawResponse);

        $cities = $response->getCities();
        $this->assertCount(2, $cities);

        $this->assertEquals(1, $response->getTotal());
        $this->assertEquals(2, $response->getCurrentPage());
        $this->assertEquals(3, $response->getPages());
        $this->assertEquals(4, $response->getPerPage());

        $this->assertEquals(
            new CityObject(
                7,
                '1 Decembrie',
                new CountyObject(26, 'Ilfov', 'IF'),
                '077005',
                0,
                '1 Decembrie'
            ),
            $cities[0]
        );

        $this->assertEquals(
            new CityObject(
                9438,
                '2 Mai',
                new CountyObject(15, 'Constanta', 'CT'),
                '907161',
                1,
                'Limanu'
            ),
            $cities[1]
        );
    }
}

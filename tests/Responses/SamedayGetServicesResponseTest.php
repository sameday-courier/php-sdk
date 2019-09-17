<?php

namespace Sameday\Tests\Responses;

use PHPUnit_Framework_TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Service\DeliveryTypeObject;
use Sameday\Objects\Service\OptionalTaxObject;
use Sameday\Objects\Service\ServiceObject;
use Sameday\Objects\Types\CostType;
use Sameday\Objects\Types\PackageType;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayGetServicesResponse;

class SamedayGetServicesResponseTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetServicesRequest();
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetServicesResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetServicesRequest();
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "total": 1,
    "currentPage": 2,
    "pages": 3,
    "perPage": 4,
    "data": [
        {
            "id": 1,
            "name": "2H",
            "serviceCode": "2H_code",
            "deliveryType": {
                "id": 1,
                "name": "Sameday"
            },
            "defaultServices": true,
            "serviceOptionalTaxes": []
        },
        {
            "id": 7,
            "name": "24H",
            "serviceCode": "24",
            "deliveryType": {
                "id": 2,
                "name": "NextDay"
            },
            "defaultServices": false,
            "serviceOptionalTaxes": [
                {
                    "costType": "Fix",
                    "id": 20,
                    "name": "Reambalare",
                    "tax": 6,
                    "packageType": 1
                },
                {
                    "costType": "Procentual",
                    "id": 23,
                    "name": "Deschidere Colet",
                    "tax": 1.1,
                    "packageType": 2
                }
            ]
        }
    ]
}
JSON
            , 200);
        $response = new SamedayGetServicesResponse($request, $rawResponse);

        $services = $response->getServices();
        $this->assertCount(2, $services);

        $this->assertEquals(1, $response->getTotal());
        $this->assertEquals(2, $response->getCurrentPage());
        $this->assertEquals(3, $response->getPages());
        $this->assertEquals(4, $response->getPerPage());

        $this->assertEquals(
            new ServiceObject(
                1,
                '2H',
                '2H_code',
                new DeliveryTypeObject(1, 'Sameday'),
                true,
                []
            ),
            $services[0]
        );

        $this->assertEquals(
            new ServiceObject(
                7,
                '24H',
                '24',
                new DeliveryTypeObject(2, 'NextDay'),
                false,
                [
                    new OptionalTaxObject(20, 'Reambalare', new CostType('Fix'), 6, new PackageType(1)),
                    new OptionalTaxObject(23, 'Deschidere Colet', new CostType('Procentual'), 1.1, new PackageType(2)),
                ]
            ),
            $services[1]
        );
    }
}

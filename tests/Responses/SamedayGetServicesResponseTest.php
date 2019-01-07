<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Service\DeliveryTypeObject;
use Sameday\Objects\Service\OptionalTaxObject;
use Sameday\Objects\Service\ServiceObject;
use Sameday\Objects\Types\CostType;
use Sameday\Objects\Types\PackageType;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayGetServicesResponse;

class SamedayGetServicesResponseTest extends \PHPUnit_Framework_TestCase
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
            "name": "foo",
            "serviceCode": "code_foo",
            "deliveryType": {
                "id": 10,
                "name": "foo_delivery"
            },
            "defaultService": false,
            "serviceOptionalTaxes": []
        },
        {
            "id": 2,
            "name": "bar",
            "serviceCode": "code_bar",
            "deliveryType": {
                "id": 20,
                "name": "bar_delivery"
            },
            "defaultService": true,
            "serviceOptionalTaxes": [
                {
                    "id": 201,
                    "name": "tax1",
                    "costType": "Fix",
                    "tax": 1,
                    "packageType": 0
                },
                {
                    "id": 202,
                    "name": "tax2",
                    "costType": "Percent",
                    "tax": 1.1,
                    "packageType": 1
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
                'foo',
                'code_foo',
                new DeliveryTypeObject(10, 'foo_delivery'),
                false,
                []
            ),
            $services[0]
        );

        $this->assertEquals(
            new ServiceObject(
                2,
                'bar',
                'code_bar',
                new DeliveryTypeObject(20, 'bar_delivery'),
                true,
                [
                    new OptionalTaxObject(201, 'tax1', new CostType('Fix'), 1, new PackageType(0)),
                    new OptionalTaxObject(202, 'tax2', new CostType('Percent'), 1.1, new PackageType(1)),
                ]
            ),
            $services[1]
        );
    }
}

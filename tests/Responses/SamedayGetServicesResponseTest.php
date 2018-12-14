<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
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


        $this->assertEquals('foo', $services[0]->getName());
        $this->assertEquals('code_foo', $services[0]->getCode());
        $this->assertFalse($services[0]->isDefault());
        $this->assertInstanceOf('Sameday\Objects\Service\DeliveryTypeObject', $services[0]->getDeliveryType());
        $this->assertEquals(10, $services[0]->getDeliveryType()->getId());
        $this->assertEquals('foo_delivery', $services[0]->getDeliveryType()->getName());
        $this->assertCount(0, $services[0]->getOptionalTaxes());

        $this->assertEquals('bar', $services[1]->getName());
        $this->assertEquals('code_bar', $services[1]->getCode());
        $this->assertTrue($services[1]->isDefault());
        $this->assertInstanceOf('Sameday\Objects\Service\DeliveryTypeObject', $services[1]->getDeliveryType());
        $this->assertEquals(20, $services[1]->getDeliveryType()->getId());
        $this->assertEquals('bar_delivery', $services[1]->getDeliveryType()->getName());
        $this->assertCount(2, $services[1]->getOptionalTaxes());
        $this->assertEquals(201, $services[1]->getOptionalTaxes()[0]->getId());
        $this->assertEquals('tax1', $services[1]->getOptionalTaxes()[0]->getName());
        $this->assertEquals('Fix', $services[1]->getOptionalTaxes()[0]->getCostType()->getType());
        $this->assertEquals(1, $services[1]->getOptionalTaxes()[0]->getTax());
        $this->assertEquals(0, $services[1]->getOptionalTaxes()[0]->getPackageType()->getType());
        $this->assertEquals(202, $services[1]->getOptionalTaxes()[1]->getId());
        $this->assertEquals('tax2', $services[1]->getOptionalTaxes()[1]->getName());
        $this->assertEquals('Percent', $services[1]->getOptionalTaxes()[1]->getCostType()->getType());
        $this->assertEquals(1.1, $services[1]->getOptionalTaxes()[1]->getTax());
        $this->assertEquals(1, $services[1]->getOptionalTaxes()[1]->getPackageType()->getType());
    }
}

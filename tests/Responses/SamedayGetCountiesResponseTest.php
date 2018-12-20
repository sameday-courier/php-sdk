<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayGetCountiesRequest;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayGetCountiesResponse;
use Sameday\Responses\SamedayGetServicesResponse;

class SamedayGetCountiesResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetCountiesRequest(null);
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetCountiesResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetCountiesRequest(null);
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
            "code": "code_foo"
        },
        {
            "id": 2,
            "name": "bar",
            "code": "code_bar"
        }        
    ]
}
JSON
            , 200);
        $response = new SamedayGetCountiesResponse($request, $rawResponse);

        $counties = $response->getCounties();
        $this->assertCount(2, $counties);

        $this->assertEquals(1, $response->getTotal());
        $this->assertEquals(2, $response->getCurrentPage());
        $this->assertEquals(3, $response->getPages());
        $this->assertEquals(4, $response->getPerPage());

        $this->assertEquals(1, $counties[0]->getId());
        $this->assertEquals('foo', $counties[0]->getName());
        $this->assertEquals('code_foo', $counties[0]->getCode());
        $this->assertEquals(2, $counties[1]->getId());
        $this->assertEquals('bar', $counties[1]->getName());
        $this->assertEquals('code_bar', $counties[1]->getCode());
    }
}

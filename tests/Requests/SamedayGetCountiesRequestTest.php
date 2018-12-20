<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayGetCountiesRequest;

class SamedayGetCountiesRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildRequest()
    {
        $request = new SamedayGetCountiesRequest(null);
        $request->setPage(2);
        $request->setCountPerPage(10);
        $request->setName('name');

        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/geolocation/county', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 2, 'countPerPage' => 10, 'name' => 'name'], $samedayRequest->getQueryParams());
    }
}

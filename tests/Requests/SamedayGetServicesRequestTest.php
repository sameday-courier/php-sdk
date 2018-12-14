<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayGetServicesRequest;

class SamedayGetServicesRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildRequest()
    {
        $request = new SamedayGetServicesRequest();
        $request->setPage(2);
        $request->setCountPerPage(10);

        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/services', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 2, 'countPerPage' => 10], $samedayRequest->getQueryParams());
    }
}

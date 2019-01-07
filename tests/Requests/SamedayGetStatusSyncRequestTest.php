<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayGetStatusSyncRequest;

class SamedayGetStatusSyncRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetStatusSyncRequest(1, 2);

        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(500, $request->getCountPerPage());
        $this->assertEquals(1, $request->getStartTimestamp());
        $this->assertEquals(2, $request->getEndTimestamp());
    }

    public function testSetGet()
    {
        $request = new SamedayGetStatusSyncRequest(1, 2);
        $request->setPage(2);
        $request->setCountPerPage(10);
        $request->setStartTimestamp(3);
        $request->setEndTimestamp(4);

        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(10, $request->getCountPerPage());
        $this->assertEquals(3, $request->getStartTimestamp());
        $this->assertEquals(4, $request->getEndTimestamp());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetStatusSyncRequest(1, 2);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/status-sync', $samedayRequest->getEndpoint());
        $this->assertEquals(['page' => 1, 'countPerPage' => 500, 'startTimestamp' => 1, 'endTimestamp' => 2], $samedayRequest->getQueryParams());
    }
}

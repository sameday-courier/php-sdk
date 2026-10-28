<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetAwbStatusSyncRequest;

class SamedayGetAwbStatusSyncRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request = new SamedayGetAwbStatusSyncRequest(1, 2);

        $this->assertEquals(1, $request->getStartTimestamp());
        $this->assertEquals(2, $request->getEndTimestamp());
        $this->assertEquals(1, $request->getPage());
        $this->assertEquals(500, $request->getCountPerPage());
    }

    public function testSetGet()
    {
        $request = new SamedayGetAwbStatusSyncRequest(1, 2);
        $request->setStartTimestamp(10);
        $request->setEndTimestamp(20);
        $request->setPage(2);
        $request->setCountPerPage(100);

        $this->assertEquals(10, $request->getStartTimestamp());
        $this->assertEquals(20, $request->getEndTimestamp());
        $this->assertEquals(2, $request->getPage());
        $this->assertEquals(100, $request->getCountPerPage());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetAwbStatusSyncRequest(1000, 2000);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/status-sync', $samedayRequest->getEndpoint());
        $this->assertEquals(
            [
                'startTimestamp' => 1000,
                'endTimestamp' => 2000,
                'page' => 1,
                'countPerPage' => 500,
            ],
            $samedayRequest->getQueryParams()
        );
    }
}

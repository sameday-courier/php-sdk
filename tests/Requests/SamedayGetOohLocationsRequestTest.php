<?php

namespace Sameday\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Sameday\Requests\SamedayGetLockersRequest;
use Sameday\Http\SamedayRequest;
use Sameday\Requests\SamedayGetOohLocationsRequest;

class SamedayGetOohLocationsRequestTest extends TestCase
{
    public function testConstructor()
    {
        $request1 = new SamedayGetLockersRequest();

        $this->assertEquals([], $request1->getLockerIds());

        $request2 = new SamedayGetLockersRequest([1, 2]);

        $this->assertEquals([1, 2], $request2->getLockerIds());
    }

    public function testSetGet()
    {
        $request = new SamedayGetLockersRequest([1]);
        $request->setLockerIds([2]);

        $this->assertEquals([2], $request->getLockerIds());
    }

    public function testBuildRequest()
    {
        $request = new SamedayGetOohLocationsRequest();
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf(SamedayRequest::class, $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/ooh-locations', $samedayRequest->getEndpoint());
        $this->assertEquals(
            [
                'page' => 1,
                'countPerPage' => 50,
            ],
            $samedayRequest->getQueryParams()
        );
    }

    public function testBuildRequestWithLockerIds()
    {
        $request = new SamedayGetOohLocationsRequest([1001, 2001]);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf(SamedayRequest::class, $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/client/ooh-locations', $samedayRequest->getEndpoint());
        $this->assertEquals(
            [
                'locationsList' => '1001,2001',
                'page' => 1,
                'countPerPage' => 50,
            ],
            $samedayRequest->getQueryParams()
        );
    }
}

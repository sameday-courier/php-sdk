<?php

namespace Sameday\Tests\Requests;

use Sameday\Requests\SamedayGetLockersRequest;

class SamedayGetLockersRequestTest extends \PHPUnit_Framework_TestCase
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
        $request = new SamedayGetLockersRequest();
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/locker/lockers', $samedayRequest->getEndpoint());
        $this->assertEmpty($samedayRequest->getQueryParams());
    }

    public function testBuildRequestWithLockerIds()
    {
        $request = new SamedayGetLockersRequest([1, 2]);
        $samedayRequest = $request->buildRequest();

        $this->assertInstanceOf('Sameday\Http\SamedayRequest', $samedayRequest);
        $this->assertTrue($samedayRequest->isNeedAuth());
        $this->assertEquals('GET', $samedayRequest->getMethod());
        $this->assertEquals('/api/locker/lockers', $samedayRequest->getEndpoint());
        $this->assertEquals(['lockersList' => '1,2'], $samedayRequest->getQueryParams());
    }
}

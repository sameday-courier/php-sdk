<?php

namespace Sameday\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use Sameday\Exceptions\SamedayServerException;

class SamedayServerExceptionTest extends TestCase
{
    public function testReturnsRawResponse()
    {
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $rawResponse = $this->createMock('Sameday\Http\SamedayRawResponse');
        $exception = new SamedayServerException($samedayRequest, $rawResponse);

        $this->assertEquals($rawResponse, $exception->getRawResponse());
        $this->assertEquals($samedayRequest, $exception->getRequest());
    }
}

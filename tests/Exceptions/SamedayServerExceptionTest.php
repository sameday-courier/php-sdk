<?php

namespace Sameday\Tests\Exceptions;

use Sameday\Exceptions\SamedayServerException;

class SamedayServerExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsRawResponse()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
        $rawResponse = \Mockery::mock('Sameday\Http\SamedayRawResponse');
        $exception = new SamedayServerException($samedayRequest, $rawResponse);

        $this->assertEquals($rawResponse, $exception->getRawResponse());
        $this->assertEquals($samedayRequest, $exception->getRequest());
    }
}

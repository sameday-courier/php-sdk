<?php

namespace Sameday\Tests\Exceptions;

use Sameday\Exceptions\SamedayServerException;
use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;

class SamedayServerExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsRawResponse()
    {
        $samedayRequest = new SamedayRequest(false, 'GET', '/endpoint');
        $rawResponse = new SamedayRawResponse([], '');
        $exception = new SamedayServerException($samedayRequest, $rawResponse);

        $this->assertEquals($rawResponse, $exception->getRawResponse());
        $this->assertEquals($samedayRequest, $exception->getRequest());
    }
}

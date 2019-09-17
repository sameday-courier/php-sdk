<?php

namespace Sameday\Tests\Exceptions;

use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Exceptions\SamedayBadRequestException;
use Sameday\Exceptions\SamedayServerException;
use Sameday\Http\SamedayRawResponse;

class SamedayBadRequestExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsRawResponse()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $rawResponse = Mockery::mock('Sameday\Http\SamedayRawResponse');
        $exception = new SamedayServerException($samedayRequest, $rawResponse);

        $this->assertEquals($rawResponse, $exception->getRawResponse());
        $this->assertEquals($samedayRequest, $exception->getRequest());
    }

    public function testErrors()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $rawResponse = new SamedayRawResponse([], <<<ERRORS
{
    "code": 400,
    "message": "Validation Failed",
    "errors": {
        "children": {
            "pickupPoint": {
                "errors": [
                    "The given pickupPoint is invalid!",
                    "This value should not be null."
                ]
            },
            "contactPerson": {},
            "thirdParty": {
                "children": {
                    "county": {},
                    "city": {
                        "errors": [
                            "Invalid city."
                        ]
                    }
                }
            }
        }
    }
}
ERRORS
        );
        $exception = new SamedayBadRequestException($samedayRequest, $rawResponse, 'message');

        $this->assertEquals('message', $exception->getMessage());
        $this->assertEquals(
            [
                ['key' => ['pickupPoint'], 'errors' => ['The given pickupPoint is invalid!', 'This value should not be null.']],
                ['key' => ['thirdParty', 'city'], 'errors' => ['Invalid city.']],
            ],
            $exception->getErrors()
        );
    }

    public function testEmptyErrors()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $rawResponse = new SamedayRawResponse([], <<<ERRORS
{
    "code": 400,
    "message": "No data found for current user."
}
ERRORS
        );
        $exception = new SamedayBadRequestException($samedayRequest, $rawResponse);

        $this->assertEquals('No data found for current user.', $exception->getMessage());
        $this->assertEmpty($exception->getErrors());
    }
}

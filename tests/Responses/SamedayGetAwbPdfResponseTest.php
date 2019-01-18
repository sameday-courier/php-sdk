<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayGetAwbPdfResponse;

class SamedayGetAwbPdfResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = \Mockery::mock('Sameday\Requests\SamedayGetAwbPdfRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetAwbPdfResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = \Mockery::mock('Sameday\Requests\SamedayGetAwbPdfRequest');
        $rawResponse = new SamedayRawResponse([], <<<PDF
CONTENT
PDF
            , 200);
        $response = new SamedayGetAwbPdfResponse($request, $rawResponse);

        $this->assertEquals('CONTENT', $response->getPdf());
    }
}

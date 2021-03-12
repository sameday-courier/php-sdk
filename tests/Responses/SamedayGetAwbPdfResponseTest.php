<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Responses\SamedayGetAwbPdfResponse;

class SamedayGetAwbPdfResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = $this->createMock('Sameday\Requests\SamedayGetAwbPdfRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetAwbPdfResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = $this->createMock('Sameday\Requests\SamedayGetAwbPdfRequest');
        $rawResponse = new SamedayRawResponse([], <<<PDF
CONTENT
PDF
            , 200);
        $response = new SamedayGetAwbPdfResponse($request, $rawResponse);

        $this->assertEquals('CONTENT', $response->getPdf());
    }
}

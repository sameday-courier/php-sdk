<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayGetAwbPdfRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for downloading an PDF for an existing AWB request.
 *
 * @package Sameday
 */
class SamedayGetAwbPdfResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * SamedayGetAwbPdfResponse constructor.
     *
     * @param SamedayGetAwbPdfRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayGetAwbPdfRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }

    /**
     * @return string
     */
    public function getPdf()
    {
        return $this->rawResponse->getBody();
    }
}

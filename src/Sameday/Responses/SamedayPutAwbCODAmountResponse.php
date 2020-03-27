<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPutAwbCODAmountRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for updating an AWB's COD amount.
 *
 * @package Sameday
 */
class SamedayPutAwbCODAmountResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * SamedayPutAwbCODAmountResponse constructor.
     *
     * @param SamedayPutAwbCODAmountRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayPutAwbCODAmountRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }
}

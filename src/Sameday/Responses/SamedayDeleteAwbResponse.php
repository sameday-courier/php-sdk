<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayDeleteAwbRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for delete AWB request.
 *
 * @package Sameday
 */
class SamedayDeleteAwbResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * SamedayDeleteAwbResponse constructor.
     *
     * @param SamedayDeleteAwbRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayDeleteAwbRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }
}

<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPutParcelSizeRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for updating a parcel size request.
 *
 * @package Sameday
 */
class SamedayPutParcelSizeResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * SamedayPutParcelSizeResponse constructor.
     *
     * @param SamedayPutParcelSizeRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayPutParcelSizeRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }
}

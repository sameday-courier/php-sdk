<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPostParcelRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for creating a new parcel for an existing AWB request.
 *
 * @package Sameday
 */
class SamedayPostParcelResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * SamedayPostParcelResponse constructor.
     *
     * @param SamedayPostParcelRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayPostParcelRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }
}

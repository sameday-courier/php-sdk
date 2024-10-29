<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayDeletePickupPointRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

class SamedayDeletePickupPointResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @param SamedayDeletePickupPointRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayDeletePickupPointRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;
    }
}

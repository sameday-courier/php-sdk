<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayRequestInterface;

/**
 * Interface that encapsulates a request+raw response pair.
 *
 * @package Sameday
 */
interface SamedayResponseInterface
{
    /**
     * @return SamedayRequestInterface
     */
    public function getRequest();

    /**
     * @return SamedayRawResponse
     */
    public function getRawResponse();
}

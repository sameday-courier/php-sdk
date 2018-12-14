<?php

namespace Sameday\Responses\Traits;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayRequestInterface;

/**
 * Trait to encapsulate a request+raw response pair.
 *
 * @package Sameday
 */
trait SamedayResponseTrait
{
    /**
     * @var SamedayRequestInterface
     */
    protected $request;

    /**
     * @var SamedayRawResponse
     */
    protected $rawResponse;

    /**
     * @inheritdoc
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @inheritdoc
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}

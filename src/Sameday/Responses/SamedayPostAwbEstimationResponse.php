<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPostAwbEstimationRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for creating a new AWB estimation request.
 *
 * @package Sameday
 */
class SamedayPostAwbEstimationResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $time;

    /**
     * SamedayPostAwbEstimationResponse constructor.
     *
     * @param SamedayPostAwbEstimationRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayPostAwbEstimationRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        $this->cost = $json['amount'];
        $this->currency = $json['currency'];
        $this->time = $json['time'];
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }
}

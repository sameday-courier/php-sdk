<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayPostAwbEstimationRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

class SamedayPostAwbEstimationResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var float
     */
    protected $amount;

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

        $this->amount = $json['amount'];
        $this->currency = $json['currency'];
        $this->time = $json['time'];
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
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
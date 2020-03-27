<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;

/**
 * Request to update Cash On Delivery amount for an AWB.
 *
 * @package Sameday
 */
class SamedayPutAwbCODAmountRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $awb;

    /**
     * @var float
     */
    protected $codAmount;

    /**
     * SamedayPutAwbCODAmountRequest constructor.
     *
     * @param string $awb
     * @param float $codAmount
     */
    public function __construct($awb, $codAmount)
    {
        $this->awb = $awb;
        $this->codAmount = $codAmount;
    }

    /**
     * @return SamedayRequest
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'PUT',
            "/api/awb/{$this->awb}/update-cod",
            [],
            new RequestBodyUrlEncoded([
                'cashOnDelivery' => $this->codAmount
            ])
        );
    }

    /**
     * @return string
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @param string $awb
     *
     * @return $this
     */
    public function setAwb($awb)
    {
        $this->awb = $awb;

        return $this;
    }

    /**
     * @return float
     */
    public function getCODAmount()
    {
        return $this->codAmount;
    }

    /**
     * @param float $codAmount
     *
     * @return $this
     */
    public function setCODAmount($codAmount)
    {
        $this->codAmount = $codAmount;

        return $this;
    }
}

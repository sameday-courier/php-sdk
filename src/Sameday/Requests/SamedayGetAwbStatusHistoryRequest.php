<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;

/**
 * Request to get awb history.
 *
 * @package Sameday
 */
class SamedayGetAwbStatusHistoryRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $awb;

    /**
     * SamedayGetAwbStatusHistoryRequest constructor.
     *
     * @param string $awb
     */
    public function __construct($awb)
    {
        $this->awb = $awb;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            "/api/client/awb/{$this->awb}/status"
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
}

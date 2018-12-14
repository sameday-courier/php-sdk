<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;

/**
 * Request to delete an AWB.
 *
 * @package Sameday
 */
class SamedayDeleteAwbRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $awb;

    /**
     * SamedayDeleteAwbRequest constructor.
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
            'DELETE',
            "/api/awb/{$this->awb}"
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

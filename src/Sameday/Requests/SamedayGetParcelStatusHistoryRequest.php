<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;

/**
 * Request to get parcel history.
 *
 * @package Sameday
 */
class SamedayGetParcelStatusHistoryRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $parcel;

    /**
     * SamedayGetParcelStatusHistoryRequest constructor.
     *
     * @param string $parcel
     */
    public function __construct($parcel)
    {
        $this->parcel = $parcel;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            "/api/client/parcel/{$this->parcel}/status-history"
        );
    }

    /**
     * @return string
     */
    public function getParcel()
    {
        return $this->parcel;
    }

    /**
     * @param string $parcel
     *
     * @return $this
     */
    public function setParcel($parcel)
    {
        $this->parcel = $parcel;

        return $this;
    }
}

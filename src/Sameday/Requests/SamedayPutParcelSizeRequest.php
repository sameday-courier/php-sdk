<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;

/**
 * Request to update a parcel size.
 *
 * @package Sameday
 */
class SamedayPutParcelSizeRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $parcel;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $length;

    /**
     * @var float
     */
    protected $height;

    /**
     * SamedayPutParcelSizeRequest constructor.
     *
     * @param string $parcel
     * @param float $weight
     * @param float $width
     * @param float $length
     * @param float $height
     */
    public function __construct($parcel, $weight, $width, $length, $height)
    {
        $this->parcel = $parcel;
        $this->weight = $weight;
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
    }

    /**
     * @return SamedayRequest
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'PUT',
            "/api/client/parcel/{$this->parcel}/size",
            [],
            new RequestBodyUrlEncoded([
                'weight' => $this->weight,
                'width' => $this->width,
                'length' => $this->length,
                'height' => $this->height,
            ])
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

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}

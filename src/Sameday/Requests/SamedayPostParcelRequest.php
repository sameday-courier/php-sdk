<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;
use Sameday\Objects\ParcelDimensionsObject;

/**
 * Request to create a new parcel for an existing AWB.
 *
 * @package Sameday
 */
class SamedayPostParcelRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $awbNumber;

    /**
     * @var ParcelDimensionsObject
     */
    protected $parcelDimensions;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var string|null
     */
    protected $observation;

    /**
     * @var string|null
     */
    protected $priceObservation;

    /**
     * @var bool
     */
    protected $last;

    /**
     * SamedayPostParcelRequest constructor.
     *
     * @param string $awbNumber
     * @param ParcelDimensionsObject $parcelDimensions
     * @param int $position
     * @param string|null $observation
     * @param string|null $priceObservation
     * @param bool $last
     */
    public function __construct(
        $awbNumber,
        ParcelDimensionsObject $parcelDimensions,
        $position,
        $observation = null,
        $priceObservation = null,
        $last = false
    ) {
        $this->awbNumber = $awbNumber;
        $this->parcelDimensions = $parcelDimensions;
        $this->position = $position;
        $this->observation = $observation;
        $this->priceObservation = $priceObservation;
        $this->last = $last;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'POST',
            "/api/awb/{$this->awbNumber}/parcel",
            [],
            new RequestBodyUrlEncoded([
                'weight' => $this->parcelDimensions->getWeight(),
                'width' => $this->parcelDimensions->getWidth(),
                'length' => $this->parcelDimensions->getLength(),
                'height' => $this->parcelDimensions->getHeight(),
                'position' => $this->position,
                'isLast' => $this->last ? 1 : 0,
                'observation' => $this->observation,
                'priceObservation' => $this->priceObservation,
            ])
        );
    }

    /**
     * @return string
     */
    public function getAwbNumber()
    {
        return $this->awbNumber;
    }

    /**
     * @param string $awbNumber
     *
     * @return $this
     */
    public function setAwbNumber($awbNumber)
    {
        $this->awbNumber = $awbNumber;

        return $this;
    }

    /**
     * @return ParcelDimensionsObject
     */
    public function getParcelDimensions()
    {
        return $this->parcelDimensions;
    }

    /**
     * @param ParcelDimensionsObject $parcelDimensions
     *
     * @return $this
     */
    public function setParcelDimensions($parcelDimensions)
    {
        $this->parcelDimensions = $parcelDimensions;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param string|null $observation
     *
     * @return $this
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriceObservation()
    {
        return $this->priceObservation;
    }

    /**
     * @param string|null $priceObservation
     *
     * @return $this
     */
    public function setPriceObservation($priceObservation)
    {
        $this->priceObservation = $priceObservation;

        return $this;
    }

    /**
     * @return bool
     */
    public function isLast()
    {
        return $this->last;
    }

    /**
     * @param bool $last
     *
     * @return $this
     */
    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }
}

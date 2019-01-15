<?php

namespace Sameday\Objects;

/**
 * Parcel dimensions.
 *
 * @package Sameday
 */
class ParcelDimensionsObject
{
    /**
     * @var float
     */
    protected $weight;

    /**
     * @var float|null
     */
    protected $width;

    /**
     * @var float|null
     */
    protected $length;

    /**
     * @var float|null
     */
    protected $height;

    /**
     * ParcelDimensionsObject constructor.
     *
     * @param float $weight
     * @param float|null $width
     * @param float|null $length
     * @param float|null $height
     */
    public function __construct($weight, $width = null, $length = null, $height = null)
    {
        $this->weight = $weight;
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
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
     * @return float|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float|null $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float|null $length
     *
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float|null $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}

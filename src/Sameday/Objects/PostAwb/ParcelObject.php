<?php

namespace Sameday\Objects\PostAwb;

/**
 * Parcel object.
 *
 * @package Sameday
 */
class ParcelObject
{
    /**
     * @var int
     */
    protected $position;

    /**
     * @var string
     */
    protected $awbNumber;

    /**
     * ParcelObject constructor.
     *
     * @param int $position
     * @param string $awbNumber
     */
    public function __construct($position, $awbNumber)
    {
        $this->position = $position;
        $this->awbNumber = $awbNumber;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getAwbNumber()
    {
        return $this->awbNumber;
    }
}

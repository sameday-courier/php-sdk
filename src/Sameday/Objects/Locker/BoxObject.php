<?php

namespace Sameday\Objects\Locker;

/**
 * Locker box.
 *
 * @package Sameday
 */
class BoxObject
{
    /**
     * @var string
     */
    protected $size;

    /**
     * @var int
     */
    protected $number;

    /**
     * BoxObject constructor.
     *
     * @param string $size
     * @param int $number
     */
    public function __construct($size, $number)
    {
        $this->size = $size;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}

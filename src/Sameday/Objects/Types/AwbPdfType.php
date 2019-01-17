<?php

namespace Sameday\Objects\Types;

/**
 * Type for awb pdf print.
 *
 * @package Sameday
 */
class AwbPdfType
{
    const A4 = 'A4';
    const A6 = 'A6';

    /**
     * @var string
     */
    protected $type;

    /**
     * AwbPdfType constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}

<?php

namespace Sameday\Objects\Types;

/**
 * Type for awb payment.
 *
 * @package Sameday
 */
class AwbPaymentType
{
    const CLIENT = 1;
    // const RECIPIENT = 2;
    // const THIRD_PARTY = 3;

    /**
     * @var int
     */
    protected $type;

    /**
     * AwbPaymentType constructor.
     *
     * @param int $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}

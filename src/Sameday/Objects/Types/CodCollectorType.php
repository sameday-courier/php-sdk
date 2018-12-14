<?php

namespace Sameday\Objects\Types;

/**
 * Type for cash-on-delivery cash collector.
 *
 * @package Sameday
 */
class CodCollectorType
{
    const CLIENT = 1;
    // const THIRD_PARTY = 0;

    /**
     * @var int
     */
    protected $type;

    /**
     * CodCollectorType constructor.
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

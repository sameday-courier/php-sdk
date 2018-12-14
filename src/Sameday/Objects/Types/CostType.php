<?php

namespace Sameday\Objects\Types;

/**
 * Type for cost.
 *
 * @package Sameday
 */
class CostType
{
    const FIXED = 'Fix';
    const PERCENT = 'Procentual';

    /**
     * @var string
     */
    protected $type;

    /**
     * CostType constructor.
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

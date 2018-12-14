<?php

namespace Sameday\Objects\Types;

/**
 * Type for person.
 *
 * @package Sameday
 */
class PersonType
{
    const INDIVIDUAL = 0;
    const COMPANY = 1;

    /**
     * @var int
     */
    protected $type;

    /**
     * PersonType constructor.
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

<?php

namespace Sameday\Objects\Types;

/**
 * Type of package.
 *
 * @package Sameday
 */
class PackageType
{
    const PARCEL = 0;
    const ENVELOPE = 1;
    const LARGE = 2;

    /**
     * @var int
     */
    protected $type;

    /**
     * PackageType constructor.
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

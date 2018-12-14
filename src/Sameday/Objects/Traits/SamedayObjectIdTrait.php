<?php

namespace Sameday\Objects\Traits;

/**
 * Trait for object id.
 *
 * @package Sameday
 */
trait SamedayObjectIdTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

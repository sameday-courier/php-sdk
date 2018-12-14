<?php

namespace Sameday\Objects\Traits;

/**
 * Trait for object name.
 *
 * @package Sameday
 */
trait SamedayObjectNameTrait
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

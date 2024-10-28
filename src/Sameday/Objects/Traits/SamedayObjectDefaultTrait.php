<?php

namespace Sameday\Objects\Traits;

/**
 * Trait for Default param
 */
trait SamedayObjectDefaultTrait
{
    /**
     * @var bool $default
     */
    protected $default;

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }
}

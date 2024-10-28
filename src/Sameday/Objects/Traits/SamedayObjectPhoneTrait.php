<?php

namespace Sameday\Objects\Traits;

trait SamedayObjectPhoneTrait
{
    /**
     * @var string $phone
     */
    private $phone;

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}

<?php

namespace Sameday\Objects\Traits;

trait SamedayObjectPhoneNumberTrait
{
    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}

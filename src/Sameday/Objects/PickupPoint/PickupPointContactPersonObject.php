<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\Traits\SamedayObjectNameTrait;
use Sameday\Objects\Traits\SamedayObjectPhoneNumberTrait;
use Sameday\Objects\Traits\SamedayObjectDefaultTrait;

class PickupPointContactPersonObject
{
    use SamedayObjectNameTrait;
    use SamedayObjectPhoneNumberTrait;
    use SamedayObjectDefaultTrait;

    /**
     * @param string $name
     */
    public function __construct(
        $name,
        $phoneNumber,
        $default
    ) {
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->default = $default;
    }
}

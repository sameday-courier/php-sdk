<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\Traits\SamedayObjectNameTrait;
use Sameday\Objects\Traits\SamedayObjectPhoneTrait;
use Sameday\Objects\Traits\SamedayObjectDefaultTrait;

class PickupPointContactPersonObject
{
    use SamedayObjectNameTrait;
    use SamedayObjectPhoneTrait;
    use SamedayObjectDefaultTrait;

    /**
     * @param string $name
     */
    public function __construct(
        $name,
        $phone,
        $default
    ) {
        $this->name = $name;
        $this->phone = $phone;
        $this->default = $default;
    }
}

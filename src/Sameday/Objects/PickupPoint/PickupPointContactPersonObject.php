<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\Traits\SamedayObjectNameTrait;
use Sameday\Objects\Traits\SamedayObjectDefaultTrait;

class PickupPointContactPersonObject
{
    use SamedayObjectNameTrait;
    use SamedayObjectDefaultTrait;

    /**
     * @var string $phoneNumber
     */
    protected $phoneNumber;

    /**
     * @param $name
     * @param $phoneNumber
     * @param $default
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

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}

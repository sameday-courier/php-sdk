<?php

namespace Sameday\Objects;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;
use Sameday\Objects\Traits\SamedayObjectPhoneNumberTrait;
use Sameday\Objects\Traits\SamedayObjectDefaultTrait;

/**
 * Contact person for pickup point.
 *
 * @package Sameday
 */
class ContactPersonObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;
    use SamedayObjectPhoneNumberTrait;
    use SamedayObjectDefaultTrait;

    /**
     * ContactPersonObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $phoneNumber
     * @param bool $default
     */
    public function __construct(
        $id,
        $name,
        $phoneNumber,
        $default
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->default = $default;
    }
}

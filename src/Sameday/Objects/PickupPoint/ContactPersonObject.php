<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\Traits\SamedayObjectDefaultTrait;
use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Contact person for pickup point.
 *
 * @package Sameday
 */
class ContactPersonObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;
    use SamedayObjectDefaultTrait;

    /**
     * @var string $phone
     */
    protected $phone;

    /**
     * ContactPersonObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $phone
     * @param bool $default
     */
    public function __construct(
        $id,
        $name,
        $phone,
        $default
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}

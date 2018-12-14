<?php

namespace Sameday\Objects\Service;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Delivery type for service.
 *
 * @package Sameday
 */
class DeliveryTypeObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * DeliveryTypeObject constructor.
     *
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

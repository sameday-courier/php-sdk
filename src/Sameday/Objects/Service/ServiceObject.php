<?php

namespace Sameday\Objects\Service;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Service.
 *
 * @package Sameday
 */
class ServiceObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var DeliveryTypeObject
     */
    protected $deliveryType;

    /**
     * @var bool
     */
    protected $default;

    /**
     * @var OptionalTaxObject[]
     */
    protected $optionalTaxes;

    /**
     * ServiceObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $code
     * @param DeliveryTypeObject $deliveryType
     * @param bool $default
     * @param OptionalTaxObject[] $optionalTaxes
     */
    public function __construct($id, $name, $code, DeliveryTypeObject $deliveryType, $default, array $optionalTaxes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->deliveryType = $deliveryType;
        $this->default = $default;
        $this->optionalTaxes = $optionalTaxes;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return DeliveryTypeObject
     */
    public function getDeliveryType()
    {
        return $this->deliveryType;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @return OptionalTaxObject[]
     */
    public function getOptionalTaxes()
    {
        return $this->optionalTaxes;
    }
}

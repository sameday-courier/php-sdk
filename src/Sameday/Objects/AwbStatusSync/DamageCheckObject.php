<?php

namespace Sameday\Objects\AwbStatusSync;

use Sameday\Objects\Traits\SamedayObjectIdTrait;

/**
 * Damage check details for an AWB status sync entry.
 *
 * @package Sameday
 */
class DamageCheckObject
{
    use SamedayObjectIdTrait;

    /**
     * @var string
     */
    protected $label;

    /**
     * DamageCheckObject constructor.
     *
     * @param int $id
     * @param string $label
     */
    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}

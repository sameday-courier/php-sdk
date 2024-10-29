<?php

namespace Sameday\Objects;

use Sameday\Objects\Traits\SamedayObjectCodeTrait;
use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Country.
 *
 * @package Sameday
 */
class CountryObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;
    use SamedayObjectCodeTrait;

    /**
     * CountryObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $code
     */
    public function __construct(
        $id,
        $name,
        $code
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
    }
}

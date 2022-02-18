<?php

namespace Sameday\Objects\PostAwb\Request;

/**
 * Awb recipient entity object.
 *
 * @package Sameday
 */
class AwbRecipientEntityObject extends EntityObject
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @param $city
     * @param $county
     * @param $address
     * @param $name
     * @param $phone
     * @param $email
     * @param $postalCode
     * @param CompanyEntityObject|null $company
     */
    public function __construct(
        $city,
        $county,
        $address,
        $name,
        $phone,
        $email,
        $postalCode,
        CompanyEntityObject $company = null
    ) {
        parent::__construct($city, $county, $address, $name, $phone, $postalCode, $company);

        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function getFields()
    {
        return array_merge(parent::getFields(), [
            'email' => $this->email,
        ]);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}

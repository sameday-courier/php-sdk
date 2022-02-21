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
     * @param CompanyEntityObject|null $company
     * @param string|null $postalCode
     */
    public function __construct(
        $city,
        $county,
        $address,
        $name,
        $phone,
        $email,
        CompanyEntityObject $company = null,
        $postalCode = null
    ) {
        parent::__construct($city, $county, $address, $name, $phone, $company, $postalCode);

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

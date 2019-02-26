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
     * AwbRecipientEntityObject constructor.
     *
     * @param string|int $city
     * @param string|int $county
     * @param string $address
     * @param string $name
     * @param string $phone
     * @param string $email
     * @param CompanyEntityObject|null $company
     */
    public function __construct(
        $city,
        $county,
        $address,
        $name,
        $phone,
        $email,
        CompanyEntityObject $company = null
    ) {
        parent::__construct($city, $county, $address, $name, $phone, $company);

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

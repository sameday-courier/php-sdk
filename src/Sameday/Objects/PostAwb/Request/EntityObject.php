<?php

namespace Sameday\Objects\PostAwb\Request;

use Sameday\Objects\Types\PersonType;

/**
 * Entity.
 *
 * @package Sameday
 */
class EntityObject
{
    /**
     * @var string|int
     */
    protected $city;

    /**
     * @var string|int
     */
    protected $county;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var CompanyEntityObject|null
     */
    protected $company;

    /**
     * EntityObject constructor.
     *
     * @param string $city
     * @param string $county
     * @param string $address
     * @param string $name
     * @param string $phone
     * @param CompanyEntityObject|null $company
     */
    public function __construct(
        $city,
        $county,
        $address,
        $name,
        $phone,
        CompanyEntityObject $company = null
    ) {
        $this->city = $city;
        $this->county = $county;
        $this->address = $address;
        $this->name = $name;
        $this->phone = $phone;
        $this->company = $company;
    }

    /**
     * Return fields to build this entity object.
     *
     * @return array
     */
    public function getFields()
    {
        $fields = [
            'name' => $this->name,
            'phoneNumber' => $this->phone,
            'address' => $this->address,
            'personType' => PersonType::INDIVIDUAL, // Default to INDIVIDUAL person type.
        ];

        if (is_int($this->city)) {
            $fields['city'] = $this->city;
        } else {
            $fields['cityString'] = $this->city;
        }

        if (is_int($this->county)) {
            $fields['county'] = $this->county;
        } else {
            $fields['countyString'] = $this->county;
        }

        if ($this->company) {
            $fields = array_merge($fields, [
                'personType' => PersonType::COMPANY, // Update person type to COMPANY.
                'companyName' => $this->company->getName(),
                'companyCui' => $this->company->getCui(),
                'companyOnrcNumber' => $this->company->getOnrcNumber(),
                'companyIban' => $this->company->getIban(),
                'companyBank' => $this->company->getBank(),
            ]);
        }

        return $fields;
    }

    /**
     * @return string|int
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string|int $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|int
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param string|int $county
     *
     * @return $this
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return CompanyEntityObject|null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param CompanyEntityObject|null $company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }
}

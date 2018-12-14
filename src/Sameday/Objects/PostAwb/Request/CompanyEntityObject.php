<?php

namespace Sameday\Objects\PostAwb\Request;

/**
 * Company entity.
 *
 * @package Sameday
 */
class CompanyEntityObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $cui;

    /**
     * @var string
     */
    protected $onrcNumber;

    /**
     * @var string
     */
    protected $iban;

    /**
     * @var string
     */
    protected $bank;

    /**
     * CompanyEntityObject constructor.
     *
     * @param string $name
     * @param string $cui
     * @param string $onrcNumber
     * @param string $iban
     * @param string $bank
     */
    public function __construct($name, $cui, $onrcNumber, $iban, $bank)
    {
        $this->name = $name;
        $this->cui = $cui;
        $this->onrcNumber = $onrcNumber;
        $this->iban = $iban;
        $this->bank = $bank;
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
    public function getCui()
    {
        return $this->cui;
    }

    /**
     * @param string $cui
     *
     * @return $this
     */
    public function setCui($cui)
    {
        $this->cui = $cui;

        return $this;
    }

    /**
     * @return string
     */
    public function getOnrcNumber()
    {
        return $this->onrcNumber;
    }

    /**
     * @param string $onrcNumber
     *
     * @return $this
     */
    public function setOnrcNumber($onrcNumber)
    {
        $this->onrcNumber = $onrcNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     *
     * @return $this
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param string $bank
     *
     * @return $this
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }
}

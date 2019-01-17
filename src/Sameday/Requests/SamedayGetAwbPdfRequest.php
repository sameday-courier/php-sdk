<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;
use Sameday\Objects\Types\AwbPdfType;

/**
 * Request to download PDF file for an existing AWB.
 *
 * @package Sameday
 */
class SamedayGetAwbPdfRequest implements SamedayRequestInterface
{
    /**
     * @var string
     */
    protected $awbNumber;

    /**
     * @var AwbPdfType
     */
    protected $awbPdfType;

    /**
     * SamedayGetAwbPdfRequest constructor.
     *
     * @param string $awbNumber
     * @param AwbPdfType $awbPdfType
     */
    public function __construct(
        $awbNumber,
        AwbPdfType $awbPdfType
    ) {
        $this->awbNumber = $awbNumber;
        $this->awbPdfType = $awbPdfType;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            "/api/awb/download/{$this->awbNumber}/{$this->awbPdfType->getType()}",
            []
        );
    }

    /**
     * @return string
     */
    public function getAwbNumber()
    {
        return $this->awbNumber;
    }

    /**
     * @param string $awbNumber
     *
     * @return $this
     */
    public function setAwbNumber($awbNumber)
    {
        $this->awbNumber = $awbNumber;

        return $this;
    }

    /**
     * @return AwbPdfType
     */
    public function getAwbPdfType()
    {
        return $this->awbPdfType;
    }

    /**
     * @param AwbPdfType $awbPdfType
     *
     * @return $this
     */
    public function setAwbPdfType($awbPdfType)
    {
        $this->awbPdfType = $awbPdfType;

        return $this;
    }
}

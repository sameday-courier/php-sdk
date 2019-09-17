<?php

namespace Sameday\Exceptions;

use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Throwable;

/**
 * Class SamedayServerException
 *
 * @package Sameday
 */
class SamedayServerException extends SamedaySDKException
{
    /**
     * @var SamedayRequest
     */
    protected $request;

    /**
     * @var SamedayRawResponse
     */
    protected $rawResponse;

    /**
     * SamedayServerException constructor.
     *
     * @param SamedayRequest $request
     * @param SamedayRawResponse $rawResponse
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(SamedayRequest $request, SamedayRawResponse $rawResponse, $message = '', $code = 0, $previous = null)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return SamedayRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return SamedayRawResponse
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}

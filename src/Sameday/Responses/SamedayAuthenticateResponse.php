<?php

namespace Sameday\Responses;

use DateTime;
use Exception;
use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayAuthenticateRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for authenticate request.
 *
 * @package Sameday
 */
class SamedayAuthenticateResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var DateTime
     */
    protected $expiresAt;

    /**
     * SamedayAuthenticateResponse constructor.
     *
     * @param SamedayAuthenticateRequest $request
     * @param SamedayRawResponse $rawResponse
     *
     * @throws Exception
     */
    public function __construct(SamedayAuthenticateRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);

        $this->token = (isset($json['token'])) ? $json['token'] : null;
        $expiresAt = DateTime::createFromFormat('Y-m-d H:i', (isset($json['expire_at'])) ? $json['expire_at'] : strtotime('tomorrow'));

        if ($expiresAt instanceof DateTime) {
            $this->expiresAt = $expiresAt;
        } else {
            $this->expiresAt = new DateTime('+10 minute');
        }
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}

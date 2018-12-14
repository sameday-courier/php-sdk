<?php

namespace Sameday;

use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Sameday\Responses\SamedayAuthenticateResponse;

/**
 * Interface that encapsulates http client requests.
 *
 * @package Sameday
 */
interface SamedayClientInterface
{
    /**
     * Send a request and return raw response.
     *
     * @param SamedayRequest $request
     *
     * @return SamedayRawResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayServerException
     * @throws Exceptions\SamedayOtherException
     */
    public function sendRequest(SamedayRequest $request);

    /**
     * Attempt to authenticate to api.
     *
     * @return SamedayAuthenticateResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayServerException
     */
    public function login();

    /**
     * Logout from api, removing persistent data.
     */
    public function logout();
}

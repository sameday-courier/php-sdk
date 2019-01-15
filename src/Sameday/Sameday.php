<?php

namespace Sameday;

use Sameday\Requests\SamedayDeleteAwbRequest;
use Sameday\Requests\SamedayGetCountiesRequest;
use Sameday\Requests\SamedayGetParcelStatusHistoryRequest;
use Sameday\Requests\SamedayGetPickupPointsRequest;
use Sameday\Requests\SamedayGetStatusSyncRequest;
use Sameday\Requests\SamedayPostAwbRequest;
use Sameday\Requests\SamedayPostParcelRequest;
use Sameday\Requests\SamedayPutParcelSizeRequest;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayDeleteAwbResponse;
use Sameday\Responses\SamedayGetCountiesResponse;
use Sameday\Responses\SamedayGetParcelStatusHistoryResponse;
use Sameday\Responses\SamedayGetPickupPointsResponse;
use Sameday\Responses\SamedayGetStatusSyncResponse;
use Sameday\Responses\SamedayPostAwbResponse;
use Sameday\Responses\SamedayPostParcelResponse;
use Sameday\Responses\SamedayPutParcelSizeResponse;
use Sameday\Responses\SamedayGetServicesResponse;

/**
 * Class that encapsulates endpoints available in sameday api.
 *
 * @package Sameday
 */
class Sameday
{
    /**
     * @var SamedayClientInterface
     */
    protected $client;

    /**
     * Sameday constructor.
     *
     * @param SamedayClientInterface $client
     */
    public function __construct(SamedayClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return SamedayClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param SamedayGetServicesRequest $request
     *
     * @return SamedayGetServicesResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayServerException
     */
    public function getServices(SamedayGetServicesRequest $request)
    {
        return new SamedayGetServicesResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetPickupPointsRequest $request
     *
     * @return SamedayGetPickupPointsResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayServerException
     */
    public function getPickupPoints(SamedayGetPickupPointsRequest $request)
    {
        return new SamedayGetPickupPointsResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayPutParcelSizeRequest $request
     *
     * @return SamedayPutParcelSizeResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayServerException
     */
    public function putParcelSize(SamedayPutParcelSizeRequest $request)
    {
        return new SamedayPutParcelSizeResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetParcelStatusHistoryRequest $request
     *
     * @return SamedayGetParcelStatusHistoryResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     * @throws \Exception
     */
    public function getParcelStatusHistory(SamedayGetParcelStatusHistoryRequest $request)
    {
        return new SamedayGetParcelStatusHistoryResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayDeleteAwbRequest $request
     *
     * @return SamedayDeleteAwbResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function deleteAwb(SamedayDeleteAwbRequest $request)
    {
        return new SamedayDeleteAwbResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayPostAwbRequest $request
     *
     * @return SamedayPostAwbResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function postAwb(SamedayPostAwbRequest $request)
    {
        return new SamedayPostAwbResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetCountiesRequest $request
     *
     * @return SamedayGetCountiesResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function getCounties(SamedayGetCountiesRequest $request)
    {
        return new SamedayGetCountiesResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetStatusSyncRequest $request
     *
     * @return SamedayGetStatusSyncResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     * @throws \Exception
     */
    public function getStatusSync(SamedayGetStatusSyncRequest $request)
    {
        return new SamedayGetStatusSyncResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayPostParcelRequest $request
     *
     * @return SamedayPostParcelResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function postParcel(SamedayPostParcelRequest $request)
    {
        return new SamedayPostParcelResponse($request, $this->client->sendRequest($request->buildRequest()));
    }
}

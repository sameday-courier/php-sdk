<?php

namespace Sameday;

use Exception;
use Sameday\Exceptions\SamedayAuthenticationException;
use Sameday\Exceptions\SamedayAuthorizationException;
use Sameday\Exceptions\SamedayBadRequestException;
use Sameday\Exceptions\SamedayNotFoundException;
use Sameday\Exceptions\SamedayOtherException;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\Exceptions\SamedayServerException;
use Sameday\Objects\AwbStatusHistory\ParcelObject;
use Sameday\Requests\SamedayDeleteAwbRequest;
use Sameday\Requests\SamedayDeletePickupPointRequest;
use Sameday\Requests\SamedayGetAwbPdfRequest;
use Sameday\Requests\SamedayGetAwbStatusHistoryRequest;
use Sameday\Requests\SamedayGetCitiesRequest;
use Sameday\Requests\SamedayGetCountiesRequest;
use Sameday\Requests\SamedayGetLockersRequest;
use Sameday\Requests\SamedayGetOohLocationsRequest;
use Sameday\Requests\SamedayGetParcelStatusHistoryRequest;
use Sameday\Requests\SamedayGetPickupPointsRequest;
use Sameday\Requests\SamedayGetStatusSyncRequest;
use Sameday\Requests\SamedayPostAwbRequest;
use Sameday\Requests\SamedayPostAwbEstimationRequest;
use Sameday\Requests\SamedayPostParcelRequest;
use Sameday\Requests\SamedayPostPickupPointRequest;
use Sameday\Requests\SamedayPutAwbCODAmountRequest;
use Sameday\Requests\SamedayPutParcelSizeRequest;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\SamedayDeleteAwbResponse;
use Sameday\Responses\SamedayDeletePickupPointResponse;
use Sameday\Responses\SamedayGetAwbPdfResponse;
use Sameday\Responses\SamedayGetAwbStatusHistoryResponse;
use Sameday\Responses\SamedayGetCitiesResponse;
use Sameday\Responses\SamedayGetCountiesResponse;
use Sameday\Responses\SamedayGetLockersResponse;
use Sameday\Responses\SamedayGetOohLocationsResponse;
use Sameday\Responses\SamedayGetParcelStatusHistoryResponse;
use Sameday\Responses\SamedayGetPickupPointsResponse;
use Sameday\Responses\SamedayGetStatusSyncResponse;
use Sameday\Responses\SamedayPostAwbEstimationResponse;
use Sameday\Responses\SamedayPostAwbResponse;
use Sameday\Responses\SamedayPostParcelResponse;
use Sameday\Responses\SamedayPostPickupPointResponse;
use Sameday\Responses\SamedayPutAwbCODAmountResponse;
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
     * @param SamedayPostPickupPointRequest $request
     *
     * @return SamedayPostPickupPointResponse
     *
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function postPickupPoint(SamedayPostPickupPointRequest $request)
    {
        return new SamedayPostPickupPointResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayDeletePickupPointRequest $request
     * @return SamedayDeletePickupPointResponse
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function deletePickupPoint(SamedayDeletePickupPointRequest $request)
    {
        return new SamedayDeletePickupPointResponse($request, $this->client->sendRequest($request->buildRequest()));
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
     * @throws Exception
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
     * @param SamedayPostAwbEstimationRequest $request
     *
     * @return SamedayPostAwbEstimationResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function postAwbEstimation(SamedayPostAwbEstimationRequest $request)
    {
        return new SamedayPostAwbEstimationResponse($request, $this->client->sendRequest($request->buildRequest()));
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
     * @param SamedayGetCitiesRequest $request
     *
     * @return SamedayGetCitiesResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function getCities(SamedayGetCitiesRequest $request)
    {
        return new SamedayGetCitiesResponse($request, $this->client->sendRequest($request->buildRequest()));
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
     * @throws Exception
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
     * @throws Exception
     */
    public function postParcel(SamedayPostParcelRequest $request)
    {
        $parcelsRequest = new SamedayGetAwbStatusHistoryRequest($request->getAwbNumber());

        // Get old parcels.
        $parcelsResponse = $this->getAwbStatusHistory($parcelsRequest);
        $oldParcels = array_map(
            function (ParcelObject $parcel) {
                return $parcel->getParcelAwbNumber();
            },
            $parcelsResponse->getParcels()
        );

        // Create new parcel.
        $response = $this->client->sendRequest($request->buildRequest());

        // Get new parcels.
        $parcelsResponse = $this->getAwbStatusHistory($parcelsRequest);
        $newParcels = array_map(
            function (ParcelObject $parcel) {
                return $parcel->getParcelAwbNumber();
            },
            $parcelsResponse->getParcels()
        );

        $newParcel = array_values(array_diff($newParcels, $oldParcels));

        return new SamedayPostParcelResponse($request, $response, $newParcel[0]);
    }

    /**
     * @param SamedayGetAwbPdfRequest $request
     *
     * @return SamedayGetAwbPdfResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function getAwbPdf(SamedayGetAwbPdfRequest $request)
    {
        return new SamedayGetAwbPdfResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetAwbStatusHistoryRequest $request
     *
     * @return SamedayGetAwbStatusHistoryResponse
     *
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     * @throws Exception
     */
    public function getAwbStatusHistory(SamedayGetAwbStatusHistoryRequest $request)
    {
        return new SamedayGetAwbStatusHistoryResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetLockersRequest $request
     *
     * @return SamedayGetLockersResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayServerException
     * @throws Exceptions\SamedayBadRequestException
     */
    public function getLockers(SamedayGetLockersRequest $request)
    {
        return new SamedayGetLockersResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayGetOohLocationsRequest $request
     * @return SamedayGetOohLocationsResponse
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayBadRequestException
     * @throws Exceptions\SamedayNotFoundException
     * @throws Exceptions\SamedayOtherException
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayServerException
     */
    public function getOohLocations(SamedayGetOohLocationsRequest $request)
    {
        return new SamedayGetOohLocationsResponse($request, $this->client->sendRequest($request->buildRequest()));
    }

    /**
     * @param SamedayPutAwbCODAmountRequest $request
     *
     * @return SamedayPutAwbCODAmountResponse
     *
     * @throws Exceptions\SamedaySDKException
     * @throws Exceptions\SamedayAuthenticationException
     * @throws Exceptions\SamedayAuthorizationException
     * @throws Exceptions\SamedayServerException
     * @throws Exceptions\SamedayBadRequestException
     */
    public function putAwbCODAmount(SamedayPutAwbCODAmountRequest $request)
    {
        return new SamedayPutAwbCODAmountResponse($request, $this->client->sendRequest($request->buildRequest()));
    }
}

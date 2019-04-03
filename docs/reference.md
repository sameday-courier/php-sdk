# Sameday Courier SDK for PHP Reference

Below is the API reference for the Sameday Courier SDK for PHP.

# Core API

These classes are at the core of the Sameday Courier SDK for PHP.

| Class name | Description |
| ------------- | ------------- |
| [`Sameday\Sameday`](reference/Sameday.md) | The main service object that helps tie all the SDK components together. |
| [`Sameday\SamedayClient`](reference/SamedayClient.md) | An entity that represents a Sameday Courier client and is required to send requests. |

# Requests

These classes are used as an API request.

| Class name | Description |
| ------------- | ------------- |
| [`Sameday\Requests\SamedayAuthenticateRequest`](reference/SamedayAuthenticateRequest.md) | An entity that represents an authentication request. |
| [`Sameday\Requests\SamedayDeleteAwbRequest`](reference/SamedayDeleteAwbRequest.md) | An entity that represents a request to delete an AWB. |
| [`Sameday\Requests\SamedayGetAwbPdfRequest`](reference/SamedayGetAwbPdfRequest.md) | An entity that represents a request to download an PDF for an existing AWB. |
| [`Sameday\Requests\SamedayGetCountiesRequest`](reference/SamedayGetCountiesRequest.md) | An entity that represents a request to get all counties (paginated). |
| [`Sameday\Requests\SamedayGetParcelStatusHistoryRequest`](reference/SamedayGetParcelStatusHistoryRequest.md) | An entity that represents a request to get status history for a parcel. |
| [`Sameday\Requests\SamedayGetPickupPointsRequest`](reference/SamedayGetPickupPointsRequest.md) | An entity that represents a request to get pickup points for current user (paginated). |
| [`Sameday\Requests\SamedayGetServicesRequest`](reference/SamedayGetServicesRequest.md) | An entity that represents a request to get available delivery services for current user (paginated). |
| [`Sameday\Requests\SamedayGetStatusSyncRequest`](reference/SamedayGetStatusSyncRequest.md) | An entity that represents a request to get all status updates that happened between two timestamps (paginated). |
| [`Sameday\Requests\SamedayPostAwbRequest`](reference/SamedayPostAwbRequest.md) | An entity that represents a request to create a new AWB. |
| [`Sameday\Requests\SamedayPostAwbEstimationRequest`](reference/SamedayPostAwbEstimationRequest.md) | An entity that represents a request to calculate estimation cost for a new AWB. |
| [`Sameday\Requests\SamedayPostParcelRequest`](reference/SamedayPostParcelRequest.md) | An entity that represents a request to create a new parcel for an existing AWB. |
| [`Sameday\Requests\SamedayPutParcelSizeRequest`](reference/SamedayPutParcelSizeRequest.md) | An entity that represents a request to update size for an existing parcel. |
| [`Sameday\Requests\SamedayGetAwbPdfRequest`](reference/SamedayGetAwbPdfRequest.md) | An entity that represents a request to get pdf for an awb. |
| [`Sameday\Requests\SamedayGetAwbStatusHistoryRequest`](reference/SamedayGetAwbStatusHistoryRequest.md) | An entity that represents a request to get status history for an awb. |

# Responses

These classes are used as an API response.

| Class name | Description |
| ------------- | ------------- |
| [`Sameday\Responses\SamedayAuthenticateResponse`](reference/SamedayAuthenticateResponse.md) | An entity that represents an authentication response. |
| [`Sameday\Responses\SamedayDeleteAwbResponse`](reference/SamedayDeleteAwbResponse.md) | An entity that represents a response to delete an AWB. |
| [`Sameday\Responses\SamedayGetAwbPdfResponse`](reference/SamedayGetAwbPdfResponse.md) | An entity that represents a response to download an PDF for an existing AWB. |
| [`Sameday\Responses\SamedayGetCountiesResponse`](reference/SamedayGetCountiesResponse.md) | An entity that represents a response to get all counties (paginated). |
| [`Sameday\Responses\SamedayGetParcelStatusHistoryResponse`](reference/SamedayGetParcelStatusHistoryResponse.md) | An entity that represents a response to get history for a parcel. |
| [`Sameday\Responses\SamedayGetPickupPointsResponse`](reference/SamedayGetPickupPointsResponse.md) | An entity that represents a response to get pickup points for current user (paginated). |
| [`Sameday\Responses\SamedayGetServicesResponse`](reference/SamedayGetServicesResponse.md) | An entity that represents a response to get available delivery services for current user (paginated). |
| [`Sameday\Responses\SamedayGetStatusSyncResponse`](reference/SamedayGetStatusSyncResponse.md) | An entity that represents a response to get all status updates that happened between two timestamps (paginated). |
| [`Sameday\Responses\SamedayPostAwbResponse`](reference/SamedayPostAwbResponse.md) | An entity that represents a response to create a new AWB. |
| [`Sameday\Responses\SamedayPostAwbEstimationResponse`](reference/SamedayPostAwbEstimationResponse.md) | An entity that represents a response to calculate estimation cost for a new AWB. |
| [`Sameday\Responses\SamedayPostParcelResponse`](reference/SamedayPostParcelResponse.md) | An entity that represents a response to create a new parcel for an existing AWB. |
| [`Sameday\Responses\SamedayPutParcelSizeResponse`](reference/SamedayPutParcelSizeResponse.md) | An entity that represents a response to update size for an existing parcel. |
| [`Sameday\Responses\SamedayGetAwbPdfResponse`](reference/SamedayGetAwbPdfResponse.md) | An entity that represents a response to get pdf for an awb. |
| [`Sameday\Responses\SamedayGetAwbStatusHistoryResponse`](reference/SamedayGetAwbStatusHistoryResponse.md) | An entity that represents a response to get history for an awb. |

# Core Exceptions

These are the core exceptions that the SDK will throw when an error occurs.

| Class name | Description |
| ------------- | ------------- |
| `Sameday\Exceptions\SamedayAuthenticationException` | Thrown when unable to authenticate current user and password. |
| `Sameday\Exceptions\SamedayAuthorizationException` | Thrown when the level of authorization is insufficient for current request. |
| `Sameday\Exceptions\SamedayBadRequestException` | Thrown when the request is invalid. |
| `Sameday\Exceptions\SamedayNotFoundException` | Thrown when the request endpoint or required data is not found. |
| `Sameday\Exceptions\SamedayOtherException` | Thrown when the response has an unknown http status code. |
| `Sameday\Exceptions\SamedaySDKException` | Thrown when there is an internal exception. |
| `Sameday\Exceptions\SamedayServerException` | Thrown when there is a server exception. |

# Extensibility

You can overwrite certain functionality of the SDK by coding to an interface and injecting an instance of your custom functionality.

| Interface name | Description |
| ------------- | ------------- |
| `Sameday\HttpClients\SamedayHttpClientInterface` | An interface to code your own HTTP client implementation. |
| `Sameday\PersistentData\SamedayPersistentDataInterface` | An interface to code your own persistent data storage implementation.  |

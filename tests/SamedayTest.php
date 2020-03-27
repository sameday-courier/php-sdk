<?php

namespace Sameday\Tests;

use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;
use Sameday\Exceptions\SamedayAuthenticationException;
use Sameday\Exceptions\SamedayAuthorizationException;
use Sameday\Exceptions\SamedayBadRequestException;
use Sameday\Exceptions\SamedayNotFoundException;
use Sameday\Exceptions\SamedayOtherException;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\Exceptions\SamedayServerException;
use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Sameday\Sameday;
use Sameday\SamedayClientInterface;

class SamedayTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MockInterface|SamedayClientInterface
     */
    protected $client;

    /**
     * @var Sameday
     */
    protected $sameday;

    protected function setUp()
    {
        $this->client = Mockery::mock('Sameday\SamedayClientInterface');
        $this->sameday = new Sameday($this->client);
    }

    public function testGetClient()
    {
        $this->assertEquals($this->client, $this->sameday->getClient());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetServices()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetServicesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getServices($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetServicesResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testGetPickupPoints()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetPickupPointsRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getPickupPoints($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetPickupPointsResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     * @throws SamedayBadRequestException
     */
    public function testPutParcelSize()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPutParcelSizeRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->putParcelSize($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPutParcelSizeResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     */
    public function testGetParcelStatusHistory()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetParcelStatusHistoryRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getParcelStatusHistory($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetParcelStatusHistoryResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testDeleteAwb()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayDeleteAwbRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->deleteAwb($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayDeleteAwbResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testPostAwb()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostAwbRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->postAwb($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPostAwbResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testPostAwbEstimation()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostAwbEstimationRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->postAwbEstimation($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPostAwbEstimationResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetCounties()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetCountiesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getCounties($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetCountiesResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetCities()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetCitiesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getCities($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetCitiesResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetStatusSync()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetStatusSyncRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getStatusSync($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetStatusSyncResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testPostParcel()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostParcelRequest', $samedayRequest);
        $request
            ->shouldReceive('getAwbNumber')
            ->andReturn('foo');

        $parcel1 = Mockery::mock('Sameday\Objects\AwbStatusHistory\ParcelObject');
        $parcel1
            ->shouldReceive('getParcelAwbNumber')
            ->andReturn('parcel1');

        $response1 = Mockery::mock('Sameday\Responses\SamedayGetAwbStatusHistoryResponse');
        $response1
            ->shouldReceive('getParcels')
            ->andReturn([$parcel1]);

        $parcel2 = Mockery::mock('Sameday\Objects\AwbStatusHistory\ParcelObject');
        $parcel2
            ->shouldReceive('getParcelAwbNumber')
            ->andReturn('parcel2');

        $response2 = Mockery::mock('Sameday\Responses\SamedayGetAwbStatusHistoryResponse');
        $response2
            ->shouldReceive('getParcels')
            ->andReturn([$parcel1, $parcel2]);

        $sameday = Mockery::mock('Sameday\Sameday', [$this->client])->makePartial();
        $sameday
            ->shouldReceive('getAwbStatusHistory')
            ->twice()
            ->andReturn($response1, $response2);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $sameday->postParcel($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPostParcelResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
        $this->assertEquals('parcel2', $response->getParcelAwbNumber());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetAwbPdf()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetAwbPdfRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getAwbPdf($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetAwbPdfResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedayNotFoundException
     * @throws SamedayOtherException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetAwbStatusHistory()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetAwbStatusHistoryRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getAwbStatusHistory($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetAwbStatusHistoryResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedayBadRequestException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     */
    public function testGetLockers()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetLockersRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->getLockers($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetLockersResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws SamedayAuthenticationException
     * @throws SamedayAuthorizationException
     * @throws SamedaySDKException
     * @throws SamedayServerException
     * @throws SamedayBadRequestException
     */
    public function testPutAwbCODAmount()
    {
        $samedayRequest = Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPutAwbCODAmountRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->putAwbCODAmount($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPutAwbCODAmountResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @param string $class
     * @param SamedayRequest $buildReturn
     *
     * @return MockInterface
     */
    protected function mockRequest($class, $buildReturn)
    {
        $request = Mockery::mock($class);
        $request
            ->shouldReceive('getPage')
            ->andReturn(1);
        $request
            ->shouldReceive('getCountPerPage')
            ->andReturn(1);
        $request
            ->shouldReceive('buildRequest')
            ->once()
            ->andReturn($buildReturn);

        return $request;
    }
}

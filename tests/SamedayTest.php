<?php

namespace Sameday\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sameday\Exceptions\SamedayAuthenticationException;
use Sameday\Exceptions\SamedayAuthorizationException;
use Sameday\Exceptions\SamedayBadRequestException;
use Sameday\Exceptions\SamedayNotFoundException;
use Sameday\Exceptions\SamedayOtherException;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\Exceptions\SamedayServerException;
use Sameday\Http\SamedayRawResponse;
use Sameday\Sameday;
use Sameday\SamedayClientInterface;

class SamedayTest extends TestCase
{
    /**
     * @var MockObject|SamedayClientInterface
     */
    protected $client;

    /**
     * @var Sameday
     */
    protected $sameday;

    private function setUpClient()
    {
        $this->client = $this->createMock('Sameday\SamedayClientInterface');
        $this->sameday = new Sameday($this->client);
    }

    public function testGetClient()
    {
        $this->setUpClient();
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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockPaginatedRequest('Sameday\Requests\SamedayGetServicesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

        $response = $this->sameday->getServices($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetServicesResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testGetPickupPoints()
    {
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockPaginatedRequest('Sameday\Requests\SamedayGetPickupPointsRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPutParcelSizeRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetParcelStatusHistoryRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayDeleteAwbRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostAwbRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostAwbEstimationRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockPaginatedRequest('Sameday\Requests\SamedayGetCountiesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockPaginatedRequest('Sameday\Requests\SamedayGetCitiesRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockPaginatedRequest('Sameday\Requests\SamedayGetStatusSyncRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

        $response = $this->sameday->getStatusSync($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayGetStatusSyncResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testPostParcel()
    {
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostParcelRequest', $samedayRequest);
        $request
            ->expects($this->once())
            ->method('getAwbNumber')
            ->willReturn('foo');

        $parcel1 = $this->createMock('Sameday\Objects\AwbStatusHistory\ParcelObject');
        $parcel1
            ->expects($this->any())
            ->method('getParcelAwbNumber')
            ->willReturn('parcel1');

        $response1 = $this->createMock('Sameday\Responses\SamedayGetAwbStatusHistoryResponse');
        $response1
            ->expects($this->once())
            ->method('getParcels')
            ->willReturn([$parcel1]);

        $parcel2 = $this->createMock('Sameday\Objects\AwbStatusHistory\ParcelObject');
        $parcel2
            ->expects($this->any())
            ->method('getParcelAwbNumber')
            ->willReturn('parcel2');

        $response2 = $this->createMock('Sameday\Responses\SamedayGetAwbStatusHistoryResponse');
        $response2
            ->expects($this->once())
            ->method('getParcels')
            ->willReturn([$parcel1, $parcel2]);

        $sameday = $this->getMockBuilder('Sameday\Sameday')
            ->setConstructorArgs([$this->client])
            ->setMethods(['getAwbStatusHistory'])
            ->getMock();

        $sameday
            ->expects($this->exactly(2))
            ->method('getAwbStatusHistory')
            ->willReturn($response1, $response2);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetAwbPdfRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetAwbStatusHistoryRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayGetLockersRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

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
        $this->setUpClient();
        $samedayRequest = $this->createMock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPutAwbCODAmountRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->expects($this->once())
            ->method('sendRequest')
            ->with($samedayRequest)
            ->willReturn($rawResponse);

        $response = $this->sameday->putAwbCODAmount($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPutAwbCODAmountResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @param $class
     * @param $buildReturn
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockRequest($class, $buildReturn)
    {
        $request = $this->createMock($class);
        $request
            ->expects($this->once())
            ->method('buildRequest')
            ->willReturn($buildReturn);

        return $request;
    }

    protected function mockPaginatedRequest($class, $buildReturn)
    {
        $request = $this->createMock($class);
        $request
            ->expects($this->any())
            ->method('getPage')
            ->willReturn(1);
        $request
            ->expects($this->any())
            ->method('getCountPerPage')
            ->willReturn(1);
        $request
            ->expects($this->once())
            ->method('buildRequest')
            ->willReturn($buildReturn);

        return $request;
    }
}

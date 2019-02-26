<?php

namespace Sameday\Tests;

use Mockery\MockInterface;
use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Sameday\Sameday;
use Sameday\SamedayClientInterface;

class SamedayTest extends \PHPUnit_Framework_TestCase
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
        $this->client = \Mockery::mock('Sameday\SamedayClientInterface');
        $this->sameday = new Sameday($this->client);
    }

    public function testGetClient()
    {
        $this->assertEquals($this->client, $this->sameday->getClient());
    }

    public function testGetServices()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testPutParcelSize()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testGetParcelStatusHistory()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testDeleteAwb()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testPostAwb()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testGetCounties()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testGetStatusSync()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
        $request = $this->mockRequest('Sameday\Requests\SamedayPostParcelRequest', $samedayRequest);

        $rawResponse = new SamedayRawResponse([], '');
        $this->client
            ->shouldReceive('sendRequest')
            ->once()
            ->with($samedayRequest)
            ->andReturn($rawResponse);

        $response = $this->sameday->postParcel($request);

        $this->assertInstanceOf('Sameday\Responses\SamedayPostParcelResponse', $response);
        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testGetAwbPdf()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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

    public function testGetAwbStatusHistory()
    {
        $samedayRequest = \Mockery::mock('Sameday\Http\SamedayRequest');
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
     * @param string $class
     * @param SamedayRequest $buildReturn
     *
     * @return MockInterface
     */
    protected function mockRequest($class, $buildReturn)
    {
        $request = \Mockery::mock($class);
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

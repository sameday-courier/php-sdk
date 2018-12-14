<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayGetParcelStatusHistoryRequest;
use Sameday\Responses\SamedayGetParcelStatusHistoryResponse;

class SamedayGetParcelStatusHistoryResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetParcelStatusHistoryRequest('foo');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetParcelStatusHistoryResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetParcelStatusHistoryRequest('foo');
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "parcelSummary": {
        "deliveredAt": "2018-10-23T18:52:39+0300",
        "lastDeliveryAttempt": "2018-10-23T18:52:39+0300",
        "delivered": true,
        "canceled": false,
        "deliveryAttempts": 1,
        "parcelAwbNumber": "1SDY241065761001",
        "parcelWeight": 1.1,
        "isPickedUp": true,
        "pickedUpAt": "2018-10-23T18:52:16+0300"
    },
    "parcelHistory": [
        {
            "statusId": 1,
            "status": "AWB Emis",
            "statusLabel": "Document de transport emis",
            "statusState": "Comanda curier primita",
            "statusDate": "2018-10-23T18:46:44+0300",
            "county": "Bucuresti",
            "reason": "reason",
            "transitLocation": "location1"
        },
        {
            "statusId": 33,
            "status": "In livrare la curier",
            "statusLabel": "In livrare la curier",
            "statusState": "Colete in curs de livrare",
            "statusDate": "2018-10-23T18:46:58+0300",
            "county": "Bucuresti",
            "reason": "reason",
            "transitLocation": "location2"
        }
    ],
    "expeditionStatus": {
        "statusId": 9,
        "status": "Livrata cu succes",
        "statusLabel": "Colet livrat",
        "statusState": "Colete livrate",
        "statusDate": "2018-10-23T18:52:39+0300",
        "county": "Bucuresti",
        "reason": "",
        "expeditionDetails": "https://sameday-api.demo.zitec.com/api/client/awb/1SDY241065761/status",
        "transitLocation": ""
    }
}
JSON
            , 200);
        $response = new SamedayGetParcelStatusHistoryResponse($request, $rawResponse);

        $summary = $response->getSummary();
        $this->assertInstanceOf('Sameday\Objects\ParcelStatusHistory\SummaryObject', $summary);
        $this->assertEquals('2018-10-23 18:52:39', $summary->getDeliveredAt()->format('Y-m-d H:i:s'));
        $this->assertEquals('2018-10-23 18:52:39', $summary->getLastDeliveryAttempt()->format('Y-m-d H:i:s'));
        $this->assertTrue($summary->isDelivered());
        $this->assertFalse($summary->isCanceled());
        $this->assertEquals(1, $summary->getDeliveryAttempts());
        $this->assertEquals('1SDY241065761001', $summary->getParcelAwbNumber());
        $this->assertEquals(1.1, $summary->getParcelWeight());
        $this->assertTrue($summary->isPickedUp());
        $this->assertEquals('2018-10-23 18:52:16', $summary->getPickedUpAt()->format('Y-m-d H:i:s'));

        $history = $response->getHistory();
        $this->assertCount(2, $history);
        $this->assertEquals(1, $history[0]->getId());
        $this->assertEquals('AWB Emis', $history[0]->getName());
        $this->assertEquals('Document de transport emis', $history[0]->getLabel());
        $this->assertEquals('Comanda curier primita', $history[0]->getState());
        $this->assertEquals('2018-10-23 18:46:44', $history[0]->getDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('Bucuresti', $history[0]->getCounty());
        $this->assertEquals('reason', $history[0]->getReason());
        $this->assertEquals('location1', $history[0]->getTransitLocation());
    }
}

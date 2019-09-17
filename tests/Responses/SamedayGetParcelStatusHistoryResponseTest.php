<?php

namespace Sameday\Tests\Responses;

use DateTime;
use Mockery;
use PHPUnit_Framework_TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\ParcelStatusHistory\ExpeditionObject;
use Sameday\Objects\ParcelStatusHistory\HistoryObject;
use Sameday\Objects\ParcelStatusHistory\SummaryObject;
use Sameday\Responses\SamedayGetParcelStatusHistoryResponse;

class SamedayGetParcelStatusHistoryResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstructorParameters()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayGetParcelStatusHistoryRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetParcelStatusHistoryResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws \Exception
     */
    public function testResponse()
    {
        $request = Mockery::mock('Sameday\Requests\SamedayGetParcelStatusHistoryRequest');
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
        "expeditionDetails": "https://foo.com/api/client/awb/1SDY241065761/status",
        "transitLocation": ""
    }
}
JSON
            , 200);
        $response = new SamedayGetParcelStatusHistoryResponse($request, $rawResponse);

        $this->assertEquals(
            new SummaryObject(
                true,
                false,
                1,
                '1SDY241065761001',
                1.1,
                true,
                new DateTime('2018-10-23T18:52:39+0300'),
                new DateTime('2018-10-23T18:52:39+0300'),
                new DateTime('2018-10-23T18:52:16+0300')
            ),
            $response->getSummary()
        );

        $history = $response->getHistory();
        $this->assertCount(2, $history);
        $this->assertEquals(
            new HistoryObject(
                1,
                'AWB Emis',
                'Document de transport emis',
                'Comanda curier primita',
                new DateTime('2018-10-23T18:46:44+0300'),
                'Bucuresti',
                'reason',
                'location1'
            ),
            $history[0]
        );
        $this->assertEquals(
            new HistoryObject(
                33,
                'In livrare la curier',
                'In livrare la curier',
                'Colete in curs de livrare',
                new DateTime('2018-10-23T18:46:58+0300'),
                'Bucuresti',
                'reason',
                'location2'
            ),
            $history[1]
        );

        $this->assertEquals(
            new ExpeditionObject(
                9,
                'Livrata cu succes',
                'Colet livrat',
                'Colete livrate',
                new DateTime('2018-10-23T18:52:39+0300'),
                'Bucuresti',
                '',
                '',
                'https://foo.com/api/client/awb/1SDY241065761/status'
            ),
            $response->getExpeditionStatus()
        );
    }
}

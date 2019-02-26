<?php

namespace Sameday\Tests\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\AwbStatusHistory\ExpeditionObject;
use Sameday\Objects\AwbStatusHistory\HistoryObject;
use Sameday\Objects\AwbStatusHistory\ParcelObject;
use Sameday\Objects\AwbStatusHistory\SummaryObject;
use Sameday\Responses\SamedayGetAwbStatusHistoryResponse;

class SamedayGetAwbStatusHistoryResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstructorParameters()
    {
        $request = \Mockery::mock('Sameday\Requests\SamedayGetAwbStatusHistoryRequest');
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetAwbStatusHistoryResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws \Exception
     */
    public function testResponse()
    {
        $request = \Mockery::mock('Sameday\Requests\SamedayGetAwbStatusHistoryRequest');
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "expeditionSummary": {
        "deliveredAt": "2019-02-26T12:37:28+0200",
        "lastDeliveryAttempt": "",
        "delivered": true,
        "canceled": false,
        "deliveryAttempts": 1,
        "servicePayment": 0.0,
        "awbWeight": 3.0,
        "cashOnDelivery": 54.6,
        "awbNumber": "1SDY241067423",
        "redirectionsAttempts": 1
    },
    "expeditionStatus": {
        "statusId": 1,
        "status": "AWB Emis",
        "statusLabel": "Document de transport emis",
        "statusState": "Comanda curier primita",
        "statusDate": "2019-02-26T09:37:28+0200",
        "county": "Bucuresti",
        "reason": "",
        "transitLocation": ""
    },
    "parcelsStatus": [
        {
            "statusId": 1,
            "status": "AWB Emis",
            "statusLabel": "Document de transport emis",
            "statusState": "Comanda curier primita",
            "statusDate": "2019-02-26T09:37:28+0200",
            "county": "",
            "parcelAwbNumber": "1SDY241067423001",
            "reason": "",
            "parcelDetails": "https:\/\/sameday-api.demo.zitec.com\/api\/client\/parcel\/1SDY241067423001\/status-history",
            "transitLocation": ""
        },
        {
            "statusId": 1,
            "status": "AWB Emis",
            "statusLabel": "Document de transport emis",
            "statusState": "Comanda curier primita",
            "statusDate": "2019-02-26T09:39:10+0200",
            "county": "",
            "parcelAwbNumber": "1SDY241067423002",
            "reason": "",
            "parcelDetails": "https:\/\/sameday-api.demo.zitec.com\/api\/client\/parcel\/1SDY241067423002\/status-history",
            "transitLocation": ""
        }
    ],
    "expeditionHistory":[
        {
            "statusId": 1,
            "status": "AWB Emis",
            "statusLabel": "Document de transport emis",
            "statusState": "Comanda curier primita",
            "statusDate": "2019-02-26T09:37:28+0200",
            "county": "Bucuresti",
            "reason": "reason",
            "transitLocation": "location1"
        }
    ]
}
JSON
            , 200);
        $response = new SamedayGetAwbStatusHistoryResponse($request, $rawResponse);

        $this->assertEquals(
            new SummaryObject(
                true,
                false,
                1,
                '1SDY241067423',
                3,
                0,
                54.6,
                1,
                new \DateTime('2019-02-26T12:37:28+0200'),
                null
            ),
            $response->getSummary()
        );

        $history = $response->getHistory();
        $this->assertCount(1, $history);
        $this->assertEquals(
            new HistoryObject(
                1,
                'AWB Emis',
                'Document de transport emis',
                'Comanda curier primita',
                new \DateTime('2019-02-26T09:37:28+0200'),
                'Bucuresti',
                'reason',
                'location1'
            ),
            $history[0]
        );

        $this->assertEquals(
            new ExpeditionObject(
                1,
                'AWB Emis',
                'Document de transport emis',
                'Comanda curier primita',
                new \DateTime('2019-02-26T09:37:28+0200'),
                'Bucuresti',
                '',
                ''
            ),
            $response->getExpeditionStatus()
        );

        $parcels = $response->getParcels();
        $this->assertCount(2, $parcels);
        $this->assertEquals(
            new ParcelObject(
                1,
                'AWB Emis',
                'Document de transport emis',
                'Comanda curier primita',
                new \DateTime('2019-02-26T09:37:28+0200'),
                '',
                '',
                '',
                '1SDY241067423001'
            ),
            $parcels[0]
        );
        $this->assertEquals(
            new ParcelObject(
                1,
                'AWB Emis',
                'Document de transport emis',
                'Comanda curier primita',
                new \DateTime('2019-02-26T09:39:10+0200'),
                '',
                '',
                '',
                '1SDY241067423002'
            ),
            $parcels[1]
        );
    }
}

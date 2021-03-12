<?php

namespace Sameday\Tests\Responses;

use DateTime;
use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\StatusSync\StatusObject;
use Sameday\Requests\SamedayGetStatusSyncRequest;
use Sameday\Responses\SamedayGetStatusSyncResponse;

class SamedayGetStatusSyncResponseTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstructorParameters()
    {
        $request = new SamedayGetStatusSyncRequest(1, 2);
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetStatusSyncResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws \Exception
     */
    public function testResponse()
    {
        $request = new SamedayGetStatusSyncRequest(1, 2);
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
    "currentPage": 1,
    "perPage": 500,
    "data": [
        {
            "status": "Livrata cu succes",
            "statusId": 9,
            "statusLabel": "Colet livrat",
            "statusState": "Colete livrate",
            "transitLocation": "",
            "statusDate": "2018-12-20T17:20:13+0200",
            "parcelAwbNumber": "1SDY241066690001",
            "reasonId": "",
            "reason": "",
            "parcelDetails": "https://foo.com/api/client/parcel/1SDY241066690001/status-history"
        },
        {
            "status": "In livrare la curier",
            "statusId": 33,
            "statusLabel": "In livrare la curier",
            "statusState": "Colete in curs de livrare",
            "transitLocation": "",
            "statusDate": "2018-12-20T17:19:41+0200",
            "parcelAwbNumber": "1SDY241066690001",
            "reasonId": 1,
            "reason": "foo",
            "parcelDetails": "https://foo.com/api/client/parcel/1SDY241066690001/status-history"
        },
        {
            "status": "AWB Emis",
            "statusId": 1,
            "statusLabel": "Document de transport emis",
            "statusState": "Comanda curier primita",
            "transitLocation": "",
            "statusDate": "2018-12-20T17:19:15+0200",
            "parcelAwbNumber": "1SDY241066690001",
            "reasonId": null,
            "reason": "",
            "parcelDetails": "https://foo.com/api/client/parcel/1SDY241066690001/status-history"
        },
        {
            "status": "Livrata cu succes",
            "statusId": 9,
            "statusLabel": "Colet livrat",
            "statusState": "Colete livrate",
            "transitLocation": "",
            "statusDate": "2018-12-20T17:17:58+0200",
            "parcelAwbNumber": "1SDY2H1066666001",
            "reasonId": "",
            "reason": "",
            "parcelDetails": "https://foo.com/api/client/parcel/1SDY2H1066666001/status-history"
        }
    ]
}
JSON
            , 200);
        $response = new SamedayGetStatusSyncResponse($request, $rawResponse);

        $this->assertNull($response->getTotal());
        $this->assertEquals(1, $response->getCurrentPage());
        $this->assertNull($response->getPages());
        $this->assertEquals(500, $response->getPerPage());


        $statuses = $response->getStatuses();
        $this->assertCount(4, $statuses);

        $this->assertEquals(
            new StatusObject(
                9,
                'Livrata cu succes',
                '1SDY241066690001',
                'Colet livrat',
                'Colete livrate',
                new DateTime('2018-12-20T17:20:13+0200'),
                null,
                '',
                'https://foo.com/api/client/parcel/1SDY241066690001/status-history'
            ),
            $statuses[0]
        );

        $this->assertEquals(
            new StatusObject(
                33,
                'In livrare la curier',
                '1SDY241066690001',
                'In livrare la curier',
                'Colete in curs de livrare',
                new DateTime('2018-12-20T17:19:41+0200'),
                1,
                'foo',
                'https://foo.com/api/client/parcel/1SDY241066690001/status-history'
            ),
            $statuses[1]
        );

        $this->assertEquals(
            new StatusObject(
                1,
                'AWB Emis',
                '1SDY241066690001',
                'Document de transport emis',
                'Comanda curier primita',
                new DateTime('2018-12-20T17:19:15+0200'),
                null,
                '',
                'https://foo.com/api/client/parcel/1SDY241066690001/status-history'
            ),
            $statuses[2]
        );

        $this->assertEquals(
            new StatusObject(
                9,
                'Livrata cu succes',
                '1SDY2H1066666001',
                'Colet livrat',
                'Colete livrate',
                new DateTime('2018-12-20T17:17:58+0200'),
                null,
                '',
                'https://foo.com/api/client/parcel/1SDY2H1066666001/status-history'
            ),
            $statuses[3]
        );
    }
}

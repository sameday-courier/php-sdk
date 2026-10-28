<?php

namespace Sameday\Tests\Responses;

use DateTime;
use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\AwbStatusSync\DamageCheckObject;
use Sameday\Objects\AwbStatusSync\StatusSyncObject;
use Sameday\Requests\SamedayGetAwbStatusSyncRequest;
use Sameday\Responses\SamedayGetAwbStatusSyncResponse;

class SamedayGetAwbStatusSyncResponseTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstructorParameters()
    {
        $request = new SamedayGetAwbStatusSyncRequest(1, 2);
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetAwbStatusSyncResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    /**
     * @throws \Exception
     */
    public function testResponse()
    {
        $request = new SamedayGetAwbStatusSyncRequest(1, 2);
        $rawResponse = new SamedayRawResponse([], <<<JSON
{
  "currentPage": 1,
  "perPage": 500,
  "data": [
    {
      "status": "Expedierea a fost înregistrată.",
      "statusId": 1,
      "statusLabel": "Expedierea a fost înregistrată.",
      "statusState": "The delivery request was registered",
      "transitLocation": "",
      "reasonId": "",
      "reason": "",
      "statusDate": "2026-10-28T08:42:53+02:00",
      "parcelAwbNumber": "1SDY241461660001",
      "createdBy": 3,
      "inReturn": false,
      "itemsNo": null,
      "lockerDetails": [],
      "oohDetails": [],
      "tobaccoCheck": 0,
      "parcelDetails": "https://sameday-api.demo.zitec.com/api/client/parcel/1SDY241461660001/status-history",
      "damageCheck": {
        "id": 0,
        "label": "Fara verificare"
      }
    },
    {
      "status": "Expedierea a fost înregistrată.",
      "statusId": 1,
      "statusLabel": "Expedierea a fost înregistrată.",
      "statusState": "The delivery request was registered",
      "transitLocation": "",
      "reasonId": "",
      "reason": "",
      "statusDate": "2026-10-28T08:40:41+02:00",
      "parcelAwbNumber": "1SDY241461659001",
      "createdBy": 3,
      "inReturn": false,
      "itemsNo": null,
      "lockerDetails": [],
      "oohDetails": [],
      "tobaccoCheck": 0,
      "parcelDetails": "https://sameday-api.demo.zitec.com/api/client/parcel/1SDY241461659001/status-history",
      "damageCheck": {
        "id": 0,
        "label": "Fara verificare"
      }
    }
  ]
}
JSON
            , 200);
        $response = new SamedayGetAwbStatusSyncResponse($request, $rawResponse);

        $this->assertNull($response->getTotal());
        $this->assertEquals(1, $response->getCurrentPage());
        $this->assertNull($response->getPages());
        $this->assertEquals(500, $response->getPerPage());

        $statuses = $response->getStatuses();
        $this->assertCount(2, $statuses);

        $this->assertEquals(
            new StatusSyncObject(
                1,
                'Expedierea a fost înregistrată.',
                '1SDY241461660001',
                'Expedierea a fost înregistrată.',
                'The delivery request was registered',
                new DateTime('2026-10-28T08:42:53+02:00'),
                '',
                null,
                '',
                3,
                false,
                null,
                [],
                [],
                0,
                'https://sameday-api.demo.zitec.com/api/client/parcel/1SDY241461660001/status-history',
                new DamageCheckObject(0, 'Fara verificare')
            ),
            $statuses[0]
        );

        $this->assertEquals(
            new StatusSyncObject(
                1,
                'Expedierea a fost înregistrată.',
                '1SDY241461659001',
                'Expedierea a fost înregistrată.',
                'The delivery request was registered',
                new DateTime('2026-10-28T08:40:41+02:00'),
                '',
                null,
                '',
                3,
                false,
                null,
                [],
                [],
                0,
                'https://sameday-api.demo.zitec.com/api/client/parcel/1SDY241461659001/status-history',
                new DamageCheckObject(0, 'Fara verificare')
            ),
            $statuses[1]
        );
    }
}

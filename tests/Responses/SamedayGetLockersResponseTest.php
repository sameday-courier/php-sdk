<?php

namespace Sameday\Tests\Responses;

use PHPUnit\Framework\TestCase;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Locker\BoxObject;
use Sameday\Objects\Locker\LockerObject;
use Sameday\Objects\Locker\ScheduleObject;
use Sameday\Requests\SamedayGetLockersRequest;
use Sameday\Responses\SamedayGetLockersResponse;

class SamedayGetLockersResponseTest extends TestCase
{
    public function testConstructorParameters()
    {
        $request = new SamedayGetLockersRequest();
        $rawResponse = new SamedayRawResponse([], '');
        $response = new SamedayGetLockersResponse($request, $rawResponse);

        $this->assertEquals($request, $response->getRequest());
        $this->assertEquals($rawResponse, $response->getRawResponse());
    }

    public function testResponse()
    {
        $request = new SamedayGetLockersRequest();
        $rawResponse = new SamedayRawResponse([], "{\"total\":2,\"currentPage\":1,\"pages\":1,\"perPage\":50,\"data\":[{\"name\":\"easybox Kaufland Aparatorii Patriei( Oltenitei)\",\"country\":\"Romania\",\"countryId\":187,\"county\":\"Bucuresti\",\"countyId\":1,\"city\":\"Sectorul 4\",\"cityId\":4,\"address\":\"Sos. Oltenitei, Nr. 388\",\"postalCode\":\"041337\",\"lat\":44.384394,\"lng\":26.140431,\"lockerId\":1001,\"supportedPayment\":1,\"clientVisible\":1,\"deliveryLogisticLocationId\":107,\"deliveryLogisticLocation\":\"B_LOCKER_A07\",\"email\":null,\"phone\":\"00000\",\"occupancyLevel\":1,\"excludedSellers\":[],\"availableBoxes\":[{\"size\":\"S\",\"number\":39},{\"size\":\"M\",\"number\":17},{\"size\":\"L\",\"number\":19}],\"reservedBoxes\":[],\"occupiedBoxes\":[{\"size\":\"S\",\"number\":3},{\"size\":\"M\",\"number\":8},{\"size\":\"L\",\"number\":1}],\"schedule\":[{\"day\":1,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":2,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":3,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":4,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":5,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":6,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":7,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"}]},{\"name\":\"easybox Boxes Food\",\"country\":\"Romania\",\"countryId\":187,\"county\":\"Dolj\",\"countyId\":18,\"city\":\"Filiasi\",\"cityId\":10380,\"address\":\"Str. Florilor, Nr. 2A\",\"postalCode\":\"205300\",\"lat\":44.55358,\"lng\":23.52228,\"lockerId\":2001,\"supportedPayment\":1,\"clientVisible\":1,\"deliveryLogisticLocationId\":117,\"deliveryLogisticLocation\":\"DJ_CRAIOVA_A02\",\"email\":null,\"phone\":null,\"occupancyLevel\":1,\"excludedSellers\":[],\"availableBoxes\":[{\"size\":\"S\",\"number\":20},{\"size\":\"M\",\"number\":4},{\"size\":\"L\",\"number\":7}],\"reservedBoxes\":[],\"occupiedBoxes\":[{\"size\":\"S\",\"number\":10},{\"size\":\"M\",\"number\":10},{\"size\":\"L\",\"number\":3}],\"schedule\":[{\"day\":1,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":2,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":3,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":4,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":5,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":6,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"},{\"day\":7,\"openingHour\":\"00:00\",\"closingHour\":\"23:59\"}]}]}", 200);
        $response = new SamedayGetLockersResponse($request, $rawResponse);

        $lockers = $response->getLockers();
        $this->assertCount(2, $lockers);
    }
}

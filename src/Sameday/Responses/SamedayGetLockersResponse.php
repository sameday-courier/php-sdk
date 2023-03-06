<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Locker\BoxObject;
use Sameday\Objects\Locker\LockerObject;
use Sameday\Objects\Locker\ScheduleObject;
use Sameday\Requests\SamedayGetLockersRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get lockers request.
 *
 * @package Sameday
 */
class SamedayGetLockersResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var LockerObject[]
     */
    protected $lockers = [];

    /**
     * SamedayGetLockersResponse constructor.
     *
     * @param SamedayGetLockersRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayGetLockersRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        foreach ($json as $locker) {
            $this->lockers[] = new LockerObject(
                $locker['lockerId'],
                $locker['name'],
                $locker['county'],
                $locker['city'],
                $locker['address'],
                $locker['postalCode'],
                $locker['lat'],
                $locker['lng'],
                $locker['phone'],
                $locker['email'],
                $locker['supportedPayment'],
                $locker['clientVisible'],
                array_map(
                    function ($entry) {
                        return new BoxObject(
                            $entry['size'],
                            $entry['number']
                        );
                    },
                    $locker['availableBoxes']
                ),
                array_map(
                    function ($entry) {
                        return new ScheduleObject(
                            $entry['day'],
                            $entry['openingHour'],
                            $entry['closingHour']
                        );
                    },
                    $locker['schedule']
                )
            );
        }
    }

    /**
     * @return LockerObject[]
     */
    public function getLockers()
    {
        return $this->lockers;
    }
}

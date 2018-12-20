<?php

namespace Sameday\Objects\Types;

/**
 * Type for delivery interval.
 *
 * @package Sameday
 */
class DeliveryIntervalServiceType
{
    protected static $intervals = [
        '3H' => [
            1 => [
                'startHour' => 10,
                'endHour' => 13,
            ],
            2 => [
                'startHour' => 14,
                'endHour' => 17,
            ],
            3 => [
                'startHour' => 19,
                'endHour' => 22,
            ],
        ],
        '2H' => [
            4 => [
                'startHour' => 9,
                'endHour' => 11,
            ],
            5 => [
                'startHour' => 11,
                'endHour' => 13,
            ],
            6 => [
                'startHour' => 13,
                'endHour' => 15,
            ],
            7 => [
                'startHour' => 15,
                'endHour' => 17,
            ],
            8 => [
                'startHour' => 17,
                'endHour' => 19,
            ],
            9 => [
                'startHour' => 19,
                'endHour' => 21,
            ],
        ],
    ];

    /**
     * @var int
     */
    protected $type;

    /**
     * DeliveryIntervalServiceType constructor.
     *
     * @param int $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return delivery intervals for given service code.
     * Keys of array will be the ids of delivery intervals.
     * Values of array will have 'startHour' and 'endHour' values for delivery interval.
     *
     * @param string $serviceCode
     *
     * @return array
     */
    public static function getDeliveryIntervals($serviceCode)
    {
        if (!isset(self::$intervals[$serviceCode])) {
            return [];
        }

        return self::$intervals[$serviceCode];
    }
}

<?php

namespace Sameday\Objects;

/**
 * Locker schedule.
 *
 * @package Sameday
 */
class ScheduleObject
{
    /**
     * @var int
     */
    protected $day;

    /**
     * @var string
     */
    protected $openingHour;

    /**
     * @var string
     */
    protected $closingHour;

    /**
     * ScheduleObject constructor.
     *
     * @param int $day
     * @param string $openingHour
     * @param string $closingHour
     */
    public function __construct($day, $openingHour, $closingHour)
    {
        $this->day = $day;
        $this->openingHour = $openingHour;
        $this->closingHour = $closingHour;
    }

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getOpeningHour()
    {
        return $this->openingHour;
    }

    /**
     * @return string
     */
    public function getClosingHour()
    {
        return $this->closingHour;
    }
}

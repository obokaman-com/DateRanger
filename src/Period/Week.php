<?php

namespace DateRanger\Period;

use DateRanger\DateRange;

final class Week extends DateRange
{
    const WEEK_START_DAY = 1;

    /**
     * @param null|string $day
     */
    public function __construct($day = null)
    {
        $day = new \DateTime($day);

        $first_day_of_week = self::getFirstDayOfWeek($day);

        $this->start = self::cloneDate($first_day_of_week)->setTime(0, 0, 0);
        $this->end   = self::cloneDate($first_day_of_week)->modify('+6 days')->setTime(23, 59, 59);

        $period = $this->getPeriod();
        foreach ($period as $day)
        {
            $this->dates[] = new Day($day->format('Y-m-d'));
        }
    }

    public static function fromWeekNumber($year, $week_number)
    {
        $date = new \DateTime();
        $date->setISODate($year, $week_number);
        return new self($date->format('Y-m-d'));
    }

    public static function getFirstDayOfWeek(\DateTime $a_day)
    {
        $day = self::cloneDate($a_day);

        $first_weekday_diff = (int) ($day->format('w') - self::WEEK_START_DAY);

        if (0 > $first_weekday_diff)
        {
            $first_weekday_diff = 7 + $first_weekday_diff;

            return $day->modify('-' . $first_weekday_diff . ' days');
        }

        return $day->modify('-' . $first_weekday_diff . ' days');
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Day
     */
    public function current()
    {
        return parent::current();
    }
}

<?php

namespace DateRanger\Period;

use DateRanger\DateRange;
use DateTimeImmutable;

class Week extends DateRange
{
    private const WEEK_START_DAY = 1;

    public function __construct(?string $date_string = null)
    {
        $date = new DateTimeImmutable($date_string);

        $first_day_of_week = self::getFirstDayOfWeek($date);

        $this->start = $first_day_of_week->setTime(0, 0, 0);
        $this->end = $first_day_of_week->modify('+6 days')->setTime(23, 59, 59);

        $period = $this->getPeriod();
        foreach ($period as $day) {
            $this->dates[] = new Day($day->format('Y-m-d'));
        }
    }

    public static function fromWeekNumber($year, $week_number): Week
    {
        $date = new DateTimeImmutable();
        $new_date = $date->setISODate($year, $week_number);
        return new self($new_date->format('Y-m-d'));
    }

    public static function getFirstDayOfWeek(DateTimeImmutable $day): DateTimeImmutable
    {
        $first_weekday_diff = (int)$day->format('w') - self::WEEK_START_DAY;

        if (0 > $first_weekday_diff) {
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

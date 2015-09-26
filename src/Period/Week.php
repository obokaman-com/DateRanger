<?php

namespace DateRanger\Period;

use DateRanger\PeriodBase;

final class Week extends PeriodBase
{
    const WEEK_START_DAY = 1;

    private function __construct(\DateTimeInterface $first_day_of_week)
    {
        $this->start = self::forceImmutableDate($first_day_of_week->setTime(0, 0, 0));
        $this->end   = $this->start->modify('+6 days')->setTime(23, 59, 59);
        $period      = $this->getPeriod();
        foreach ($period as $day)
        {
            $this->dates[] = new Day($day);
        }
    }

    public static function fromDay(\DateTimeInterface $a_day)
    {
        return new self(self::getFirstDayOfWeek($a_day));
    }

    public static function getFirstDayOfWeek(\DateTimeInterface $a_day)
    {
        $a_day = self::forceImmutableDate($a_day);

        $first_weekday_diff = (int) ($a_day->format('w') - self::WEEK_START_DAY);

        if (0 > $first_weekday_diff)
        {
            $first_weekday_diff = 7 + $first_weekday_diff;

            return $a_day->modify('-' . $first_weekday_diff . ' days');
        }

        return $a_day->modify('-' . $first_weekday_diff . ' days');
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Day
     */
    public function current()
    {
        return current($this->dates);
    }
}

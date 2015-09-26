<?php

namespace DateRanger\Period;

use DateRanger\PeriodBase;

final class Year extends PeriodBase
{
    private function __construct(\DateTimeInterface $first_day_of_year, \DateTimeInterface $last_day_of_year)
    {
        $this->start = $this->forceImmutableDate($first_day_of_year->setTime(0, 0, 0));
        $this->end   = $this->forceImmutableDate($last_day_of_year->setTime(23, 59, 59));
        $period      = $this->getPeriod('P1M');
        foreach ($period as $month)
        {
            $this->dates[] = Month::fromDay($month);
        }
    }

    public static function fromYear($year)
    {
        $start = new \DateTimeImmutable($year . '-1-1');
        $end   = new \DateTimeImmutable($year . '-12-31');

        return new self($start, $end);
    }

    public static function fromDay(\DateTimeInterface $day)
    {
        $year  = $day->format('Y');
        $start = new \DateTimeImmutable($year . '-1-1');
        $end   = new \DateTimeImmutable($year . '-12-31');

        return new self($start, $end);
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Month
     */
    public function current()
    {
        return current($this->dates);
    }
}

<?php

namespace DateRanger\Period;

use DateRanger\DateRange;
use DateTimeImmutable;

class Month extends DateRange
{
    public function __construct(?string $date_string = null)
    {
        $date = new DateTimeImmutable($date_string);

        $this->start = $date->modify('first day of this month')->setTime(0, 0, 0);
        $this->end = $date->modify('last day of this month')->setTime(23, 59, 59);

        $period = $this->getPeriod('P7D', Week::getFirstDayOfWeek($this->start()));
        foreach ($period as $week) {
            $this->dates[] = new Week($week->format('Y-m-d'));
        }
    }

    public static function fromMonth($year, $month): Month
    {
        return new self($year . '-' . $month . '-1');
    }

    public function isOutOfMonth(DateRange $period): bool
    {
        return !$this->overlaps($period);
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Week
     */
    public function current()
    {
        return parent::current();
    }
}

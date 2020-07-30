<?php

namespace DateRanger\Period;

use DateRanger\DateRange;
use DateTimeImmutable;

class Year extends DateRange
{
    public function __construct(?string $date_string = null)
    {
        $date = new DateTimeImmutable($date_string);

        $this->start = $date->modify('first day of january')->setTime(0, 0, 0);
        $this->end = $date->modify('last day of december')->setTime(23, 59, 59);

        $period = $this->getPeriod('P1M');
        foreach ($period as $month) {
            $this->dates[] = new Month($month->format('Y-m-d'));
        }
    }

    public static function fromYear($year): Year
    {
        return new self($year . '-1-1');
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Month
     */
    public function current()
    {
        return parent::current();
    }
}

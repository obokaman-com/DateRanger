<?php

namespace DateRanger\Period;

use DateRanger\DateRange;

final class Year extends DateRange
{
    /**
     * @param null|string $day
     */
    public function __construct($day = null)
    {
        $day = new \DateTime($day);

        $this->start = $this->cloneDate($day)->modify('first day of january')->setTime(0, 0, 0);
        $this->end   = $this->cloneDate($day)->modify('last day of december')->setTime(23, 59, 59);

        $period = $this->getPeriod('P1M');
        foreach ($period as $month)
        {
            $this->dates[] = new Month($month->format('Y-m-d'));
        }
    }

    public static function fromYear($year)
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

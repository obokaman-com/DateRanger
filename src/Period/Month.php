<?php

namespace DateRanger\Period;

use DateRanger\DateRange;

final class Month extends DateRange
{
    /**
     * @param null|string $day
     */
    public function __construct($day = null)
    {
        $day = new \DateTime($day);

        $this->start = self::cloneDate($day)->modify('first day of this month')->setTime(0, 0, 0);
        $this->end   = self::cloneDate($day)->modify('last day of this month')->setTime(23, 59, 59);

        $period = $this->getPeriod('P7D', Week::getFirstDayOfWeek($this->start()));
        foreach ($period as $week)
        {
            $this->dates[] = new Week($week->format('Y-m-d'));
        }
    }

    public static function fromMonth($year, $month)
    {
        return new self($year . '-' . $month . '-1');
    }

    public function isOutOfMonth(DateRange $period)
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

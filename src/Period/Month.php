<?php

namespace DateRanger\Period;

use DateRanger\PeriodBase;

final class Month extends PeriodBase
{
    private function __construct(\DateTimeInterface $first_day_of_month, \DateTimeInterface $last_day_of_month)
    {
        $this->start = $this->forceImmutableDate($first_day_of_month->setTime(0, 0, 0));
        $this->end   = $this->forceImmutableDate($last_day_of_month->setTime(23, 59, 59));
        $period      = $this->getPeriod('P7D');
        foreach ($period as $week)
        {
            $this->dates[] = Week::fromDay($week);
        }
    }

    public static function fromMonth($year, $month)
    {
        $start = new \DateTimeImmutable($year . '-' . $month . '-1');
        $end   = $start->modify('last day of this month');

        return new self($start, $end);
    }

    public static function fromDay(\DateTimeInterface $day)
    {
        $day   = self::forceImmutableDate($day);
        $start = $day->modify('first day of this month');
        $end   = $day->modify('last day of this month');

        return new self($start, $end);
    }

    /**
     * @param \DateTimeInterface|PeriodBase $period
     *
     * @return bool
     */
    public function isOutOfMonth($period)
    {
        if ($period instanceof \DateTimeInterface)
        {
            return !$this->overlaps(new Day($period));
        }
        return !$this->overlaps($period);
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Week
     */
    public function current()
    {
        return current($this->dates);
    }
}

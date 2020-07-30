<?php

namespace DateRanger;

use Countable;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeImmutable;
use Iterator;

abstract class DateRange implements Iterator, Countable
{
    /** @var DateTime */
    protected $start;
    /** @var DateTime */
    protected $end;
    /** @var array */
    protected $dates = [];

    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    public function end(): DateTimeImmutable
    {
        return $this->end;
    }

    public function getPeriod($interval = 'P1D', DateTimeImmutable $start = null, DateTimeImmutable $end = null): DatePeriod
    {
        if (null === $start) {
            $start = $this->start;
        }

        if (null === $end) {
            $end = $this->end;
        }

        return new DatePeriod($start, new DateInterval($interval), $end);
    }

    public function equals(self $period): bool
    {
        return $this->start()->format('YmdHis') === $period->start()->format('YmdHis') && $this->end()->format('YmdHis') === $period->end()->format('YmdHis');
    }

    public function overlaps(self $period): bool
    {
        return $this->start() <= $period->end() && $this->end() >= $period->start();
    }

    public function isCurrent(): bool
    {
        $period = new static();

        return $this->equals($period);
    }

    public function current()
    {
        return current($this->dates);
    }

    public function next()
    {
        next($this->dates);
    }

    public function key()
    {
        return key($this->dates);
    }

    public function valid()
    {
        return current($this->dates);
    }

    public function rewind()
    {
        reset($this->dates);
    }

    public function count()
    {
        return count($this->dates);
    }
}

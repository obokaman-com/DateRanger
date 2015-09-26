<?php

namespace DateRanger;

abstract class PeriodBase implements \Iterator, \Countable
{
    /** @var \DateTimeImmutable */
    protected $start;

    /** @var \DateTimeImmutable */
    protected $end;

    /** @var array */
    protected $dates = [];

    protected static function forceImmutableDate(\DateTimeInterface $date)
    {
        if ($date instanceof \DateTimeImmutable)
        {
            return $date;
        }

        /** @var \DateTime $date */

        return \DateTimeImmutable::createFromMutable($date);
    }

    public function start()
    {
        return $this->start;
    }

    public function end()
    {
        return $this->end;
    }

    public function getPeriod($interval = 'P1D')
    {
        $period = new \DatePeriod($this->start, new \DateInterval($interval), $this->end);
        return iterator_to_array($period);
    }

    public function overlaps(self $period)
    {
        return (bool) ($this->start() <= $period->end() && $this->end() >= $period->start());
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

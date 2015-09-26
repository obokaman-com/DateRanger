<?php

namespace DateRanger;

abstract class DateRange implements \Iterator, \Countable
{
    /** @var \DateTime */
    protected $start;

    /** @var \DateTime */
    protected $end;

    /** @var array */
    protected $dates = [];

    /**
     * @param null|string $day
     */
    abstract public function __construct($day = null);

    protected static function cloneDate(\DateTime $date)
    {
        return clone $date;
    }

    public function start()
    {
        return $this->start;
    }

    public function end()
    {
        return $this->end;
    }

    public function getPeriod($interval = 'P1D', \DateTime $start = null, \DateTime $end = null)
    {
        if (null === $start)
        {
            $start = $this->start;
        }

        if (null === $end)
        {
            $end = $this->end;
        }
        $period = new \DatePeriod($start, new \DateInterval($interval), $end);

        return iterator_to_array($period);
    }

    public function equals(self $period)
    {
        return (bool) $this->start()->format('YmdHis') == $period->start()->format('YmdHis') && $this->end()->format('YmdHis') == $period->end()->format('YmdHis');
    }

    public function overlaps(self $period)
    {
        return (bool) ($this->start() <= $period->end() && $this->end() >= $period->start());
    }

    public function isCurrent()
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

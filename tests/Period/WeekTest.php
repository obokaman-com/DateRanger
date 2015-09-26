<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Week;

final class WeekTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function validWeek()
    {
        $week = Week::fromDay(new \DateTimeImmutable('now'));
        $this->assertEquals(date('Y-m-W'), $week->start()->format('Y-m-W'));
    }

}

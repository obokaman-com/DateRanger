<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Week;

final class WeekTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function getCorrectFirstDayWeek()
    {
        $week = new Week('2015-01-01');
        $this->assertEquals(date('Y-m-d', strtotime('2014-12-29')), $week->start()->format('Y-m-d'));
    }

    /** @test */
    public function createFromWeekNumber()
    {
        $week1 = new Week('2015-02-12');
        $week2 = Week::fromWeekNumber(2015, 7);
        $this->assertEquals($week1, $week2);
    }
}

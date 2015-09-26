<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;

final class DayTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function validDay()
    {
        $day = new Day();
        $this->assertEquals(date('Y-m-d'), $day->start()->format('Y-m-d'));
    }

    /** @test */
    public function detectHoliday()
    {
        $day = new Day('2015-01-01');
        $this->assertTrue($day->isHoliday());
    }

    /** @test */
    public function detectWeekend()
    {
        $day = new Day('2015-09-27');
        $this->assertTrue($day->isWeekend());
    }
}

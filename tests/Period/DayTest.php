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
        $day1 = new Day('2015-01-01');
        $day2 = new Day('2015-04-06');
        $day3 = new Day('2015-04-11');
        $day4 = new Day('2015-04-15');

        $this->assertTrue($day1->isHoliday());
        $this->assertTrue($day2->isHoliday());
        $this->assertTrue($day3->isHoliday());
        $this->assertFalse($day4->isHoliday());
    }

    /** @test */
    public function detectWeekend()
    {
        $day = new Day('2015-09-27');
        $this->assertTrue($day->isWeekend());
    }

    /** @test */
    public function shouldDetectDifferentDays()
    {
        $day1 = new Day('2015-09-27');
        $day2 = new Day('2015-09-26');

        $this->assertFalse($day1->equals($day2));
    }

    /** @test */
    public function shouldDetectCurrentDay()
    {
        $day = new Day('now');

        $this->assertTrue($day->isCurrent());
    }
}

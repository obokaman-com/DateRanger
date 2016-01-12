<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;
use DateRanger\Period\Month;
use DateRanger\Period\Week;

final class MonthTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function validMonth()
    {
        $month1 = new Month();
        $this->assertEquals(date('Y-m'), $month1->start()->format('Y-m'));

        $month2 = Month::fromMonth(date('Y'), date('m'));
        $this->assertEquals(date('Y-m'), $month2->start()->format('Y-m'));
    }

    /** @test */
    public function outsiderDays()
    {
        $month = new Month('2015-09-01');

        $day_inside         = new Day('2015-08-20');
        $day_outside        = new Day('2015-09-20');
        $day_outside_string = new \DateTime('2015-09-20');

        $this->assertTrue($month->isOutOfMonth($day_inside));
        $this->assertFalse($month->isOutOfMonth($day_outside));
        $this->assertFalse($month->isOutOfMonth($day_outside_string));
    }


    /** @test */
    public function shouldContainWeeks()
    {
        $week = new Month();
        foreach ($week as $position => $day)
        {
            $this->assertInstanceOf(Week::class, $day);
        }
    }

}

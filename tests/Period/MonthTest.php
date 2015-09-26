<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;
use DateRanger\Period\Month;

final class MonthTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function validMonth()
    {
        $month = new Month();
        $this->assertEquals(date('Y-m'), $month->start()->format('Y-m'));
    }

    /** @test */
    public function outsiderDays()
    {
        $month = new Month('2015-09-01');
        $day = new Day('2015-08-20');

        $this->assertTrue($month->isOutOfMonth($day));
    }
}

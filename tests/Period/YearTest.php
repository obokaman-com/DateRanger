<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Month;
use DateRanger\Period\Year;

final class YearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function validYear()
    {
        $year1 = new Year();
        $this->assertEquals(date('Y'), $year1->start()->format('Y'));

        $year2 = Year::fromYear(date('Y'));
        $this->assertEquals(date('Y'), $year2->start()->format('Y'));
    }

    /**
     * @test
     */
    public function validContents()
    {
        $year = new Year();
        $this->assertEquals(12, count($year));
    }

    /** @test */
    public function shouldContainMonths()
    {
        $week = new Year();
        foreach ($week as $position => $day)
        {
            $this->assertInstanceOf(Month::class, $day);
        }
    }
}

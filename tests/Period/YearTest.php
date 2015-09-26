<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Year;

final class YearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function validYear()
    {
        $year = new Year();
        $this->assertEquals(date('Y'), $year->start()->format('Y'));
    }

    /**
     * @test
     */
    public function validContents()
    {
        $year = new Year();
        $this->assertEquals(12, count($year));
    }
}

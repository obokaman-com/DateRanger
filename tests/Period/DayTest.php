<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;

final class DayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function validDay()
    {
        $day = new Day(new \DateTimeImmutable('now'));
        $this->assertEquals(date('Y-m-d'), $day->start()->format('Y-m-d'));
    }
}

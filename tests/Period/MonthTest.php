<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Month;

final class MonthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function validMonth()
    {
        $month = Month::fromDay(new \DateTimeImmutable('now'));
        $this->assertEquals(date('Y-m'), $month->start()->format('Y-m'));
    }
}

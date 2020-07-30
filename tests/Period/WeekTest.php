<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;
use DateRanger\Period\Week;
use PHPUnit\Framework\TestCase;

final class WeekTest extends TestCase
{
    /** @test */
    public function shouldGetCorrectFirstDayWeek(): void
    {
        $week = new Week('2015-01-01');
        self::assertEquals(date('Y-m-d', strtotime('2014-12-29')), $week->start()->format('Y-m-d'));
    }

    /** @test */
    public function shouldCreateFromWeekNumber(): void
    {
        $week1 = new Week('2015-02-12');
        $week2 = Week::fromWeekNumber(2015, 7);

        self::assertEquals($week1, $week2);
    }

    /** @test */
    public function shouldContainDays(): void
    {
        $week = new Week();
        $day_model = new Day();

        foreach ($week as $position => $day) {
            self::assertInstanceOf(get_class($day_model), $day);
        }
    }
}

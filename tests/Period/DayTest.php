<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;
use PHPUnit\Framework\TestCase;

final class DayTest extends TestCase
{
    /** @test */
    public function shouldAcceptAValidDay(): void
    {
        $day = new Day();
        self::assertEquals(date('Y-m-d'), $day->start()->format('Y-m-d'));
    }

    /** @test */
    public function shouldDetectHoliday(): void
    {
        $day1 = new Day('2015-01-01');
        $day2 = new Day('2015-04-06');
        $day3 = new Day('2015-04-11');
        $day4 = new Day('2015-04-15');

        self::assertTrue($day1->isHoliday());
        self::assertTrue($day2->isHoliday());
        self::assertTrue($day3->isHoliday());
        self::assertFalse($day4->isHoliday());
    }

    /** @test */
    public function shouldDetectWeekend(): void
    {
        $day1 = new Day('2015-09-27');
        $day2 = new Day('2015-09-27');
        self::assertTrue($day1->isWeekend());
        self::assertTrue($day2->isWeekend());
    }

    /** @test */
    public function shouldDetectDifferentDays(): void
    {
        $day1 = new Day('2015-09-27');
        $day2 = new Day('2015-09-26');

        self::assertFalse($day1->equals($day2));
    }

    /** @test */
    public function shouldDetectCurrentDay(): void
    {
        $day = new Day('now');

        self::assertTrue($day->isCurrent());
    }
}

<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Day;
use DateRanger\Period\Month;
use DateRanger\Period\Week;
use PHPUnit\Framework\TestCase;

final class MonthTest extends TestCase
{
    /** @test */
    public function shouldAcceptAValidMonth(): void
    {
        $month1 = new Month();
        self::assertEquals(date('Y-m'), $month1->start()->format('Y-m'));

        $month2 = Month::fromMonth(date('Y'), date('m'));
        self::assertEquals(date('Y-m'), $month2->start()->format('Y-m'));
    }

    /** @test */
    public function shouldDetectOutsiderDays(): void
    {
        $month = new Month('2015-09-01');

        $day_inside = new Day('2015-08-20');
        $day_outside = new Day('2015-09-20');

        self::assertTrue($month->isOutOfMonth($day_inside));
        self::assertFalse($month->isOutOfMonth($day_outside));
    }

    /** @test */
    public function shouldContainWeeks(): void
    {
        $month = new Month();
        $week_model = new Week();

        foreach ($month as $position => $week) {
            self::assertInstanceOf(get_class($week_model), $week);
        }
    }
}

<?php

namespace DateRangerTest\Period;

use DateRanger\Period\Month;
use DateRanger\Period\Year;
use PHPUnit\Framework\TestCase;

final class YearTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAcceptAValidYear(): void
    {
        $year1 = new Year();
        self::assertEquals(date('Y'), $year1->start()->format('Y'));

        $year2 = Year::fromYear(date('Y'));
        self::assertEquals(date('Y'), $year2->start()->format('Y'));
    }

    /**
     * @test
     */
    public function shouldGenerateValidContents()
    {
        $year = new Year();
        self::assertEquals(12, count($year));
    }

    /** @test */
    public function shouldContainMonths(): void
    {
        $year = new Year();
        $month_model = new Month();

        foreach ($year as $position => $month) {
            self::assertInstanceOf(get_class($month_model), $month);
        }
    }
}

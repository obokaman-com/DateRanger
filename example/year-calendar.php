<?php
include "./../vendor/autoload.php";

use DateRanger\Period\Day;
use DateRanger\Period\Month;
use DateRanger\Period\Year;

$year = Year::fromYear(2015);

echo "<h1>" . $year->start()->format('Y') . "</h1>";

foreach ($year as $month)
{
    echo "<table><caption>" . $month->start()->format('F') . "</caption>";
    echo "<thead><tr><th>L</th><th>M</th><th>X</th><th>J</th><th>V</th><th>S</th><th>D</th></tr></thead><tbody>";
    foreach ($month as $week)
    {
        echo "<tr>";
        foreach ($week as $day)
        {
            echo "<td>";
            if ($month->isOutOfMonth($day))
            {
                echo '<span style="color:#efefef">' . $day->start()->format('d') . '</span>';
            }
            elseif ($day->isCurrent())
            {
                echo '<strong style="color:blue">' . $day->start()->format('d') . '</strong>';
            }
            elseif ($day->isWeekend())
            {
                echo '<span style="color:#ccc">' . $day->start()->format('d') . '</span>';
            }
            elseif ($day->isHoliday())
            {
                echo '<span style="color:red">' . $day->start()->format('d') . '</span>';
            }
            else
            {
                echo $day->start()->format('d');
            }
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
}

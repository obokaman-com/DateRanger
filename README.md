# DateRanger
[![Build Status](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/badges/build.png?b=master)](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/build-status/master) [![Code Coverage](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/obokaman-com/DateRanger/?branch=master)

DateRanger library offer an easy way to create date ranges, allowing to create your own special ranges extending `DateRange` or reuse the basic ones included in the library itself (`Year`, `Month`, `Week` or `Day`). This library was inspired by others like [Calendr](https://github.com/yohang/CalendR) by [Yohan Giarelli](http://yohan.giarel.li/) or [Period](http://period.thephpleague.com/) by [The PHP League](http://thephpleague.com/)



## Installation
DateRanger is available on packagist, so you can easily install with [Composer](https://getcomposer.org/).

Just run the following command:

```bash
$ composer require obokaman/dateranger
```

or include the library in your project's composer.json:

```javascript
    "require": {
        "php": ">=7.2",
        [...]
        "obokaman/dateranger": "^0.1",
        [...]
    },
```

## Example

```php
<?php

include('vendor/autoload.php');

use DateRanger\Period\Year;

$year = new Year();

echo "<h1>{$year->start()->format('Y')}</h1>";
foreach ($year as $month) {
    echo "<table><caption>{$month->start()->format('F')}</caption>";
    echo "<thead><tr><th></th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr></thead><tbody>";
    foreach ($month as $week) {
        echo "<tr><td><small>{$week->start()->format('W')}</small></td>";
        foreach ($week as $day) {
            if (!$day->overlaps($month)) $day_color = '#ddd;';
            elseif ($day->isHoliday()) $day_color = 'red;';
            else $day_color = '#333';

            echo "<td style='border:1px solid #ccc;color:{$day_color}'>";
            echo $day->start()->format('d') . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
}

```

## Basic usage

Library provides several date range objects that extends from `DateRange`. All these objects share some functionality:

* `start()` return a DateTimeImmutable object with the start date for the period.
* `end()` return a DateTimeImmutable object with the end date for the period.
* `getPeriod(string $interval)` returns a DatePeriod object based on the current DateRange, following the given interval in string format (same values accepted by DateInterval constructor).
* `overlaps(DateRange $period)` returns a boolean indicating if period overlaps with other DateRange passed as argument.
* `isCurrent()` returns a boolean indicating if period is the current one: current year, month, week or day, depending on the class being used.
* `equals(DateRange $period)` compares start and end dates between current period and the one passed as argument.

As told above, all date range objects extend from `DateRange`, wich implements `Iterator` and `Countable`, so it's possible to iterate through their "children periods" directly using `foreach` or know how many of them are contained by using `count`. 

For instance:

```php
$year = Year::fromYear(2014);
echo count($year); // returns 12.
```

```php
$month = new Month('2014-01-01');
echo count($month) . PHP_EOL; // returns 5 (weeks).

echo $month->start()->format('F') . PHP_EOL; // returns 'January'.
foreach ($month as $week) {
    foreach ($week as $day) {
        if ($month->isOutOfMonth($day)) continue;
        echo $day->start()->format('Y-m-d') . PHP_EOL; // returns 2014-01-01\n [...]
    }
}
```

## Contribute

Comments, feedback and PR are more than welcome!

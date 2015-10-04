# DateRanger
[![Build Status](https://travis-ci.org/obokaman-com/DateRanger.svg?branch=master)](https://travis-ci.org/obokaman-com/DateRanger) [![Coverage Status](https://coveralls.io/repos/obokaman-com/DateRanger/badge.svg?branch=master&service=github)](https://coveralls.io/github/obokaman-com/DateRanger?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/bf7b5c30-ee2d-47ec-97af-e89aa848707f/mini.png)](https://insight.sensiolabs.com/projects/bf7b5c30-ee2d-47ec-97af-e89aa848707f)

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
        "php": ">=5.4",
        [...]
        "obokaman/dateranger": "^0.1.2",
        [...]
    },
```

## Example

```php
<?php
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
            echo $day->start()->format('d');
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
}
```

## Basic usage

Library provides several date range objects that extends from `DateRange`. All these objects share some functionality:

* `start()` return a DateTime object with the start date for the period.
* `end()` return a DateTime object with the end date for the period.
* `getPeriod(string $interval)` returns an array with DateTime objects following the given interval in string format (same values accepted by DateInterval constructor).
* `overlaps(DateRange $period)` returns a boolean indicating if period overlaps with the one passed as argument.
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
echo count($month); // returns 31.
echo $month->start()->format('F'); // returns 'January'.
foreach ($month as $day)
{
	echo $day->start()->format('Y-m-d') . PHP_EOL; // returns 2014-01-01\n [...].
}
```

## Contribute

Comments, feedback and PR are more than welcome!

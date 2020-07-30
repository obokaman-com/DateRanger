<?php

namespace DateRanger\Period;

use DateRanger\DateRange;
use DateTimeImmutable;

class Day extends DateRange
{
    public $weekend = [6, 0];
    public $holidays = [
        '*-01-01', // Año nuevo
        '*-01-06', // Reyes
        '*-05-01', // Día del trabajador
        '*-06-01', // Fiesta local
        '*-06-24', // San Juan
        '*-08-15', // Asunción de la Virgen
        '*-09-11', // Diada
        '*-09-24', // La Mercé
        '*-10-12', // Dia Hispanidad
        '*-11-01', // Tots Sants
        '*-12-06', // Dia de la Constitución
        '*-12-08', // Immaculada Concepción
        '*-12-25', // Navidad
        '*-12-26', // San Esteban

        '2015-04-03', // Viernes Santo
        '2015-04-06', // Lunes de Pascua
        '2016-03-25', // Viernes Santo
        '2016-03-28', // Lunes de Pascua
        '2016-05-16', // Segunda Pascua
    ];

    public function __construct(?string $date_string = null)
    {
        $date = new DateTimeImmutable($date_string);

        $this->start = $date->setTime(0, 0, 0);
        $this->end = $date->setTime(23, 59, 59);

        $this->dates = [$date->setTime(0, 0, 0)];
    }

    public function isWeekend(): bool
    {
        return in_array((int) $this->start()->format('w'), $this->weekend, true);
    }

    public function isHoliday(): bool
    {
        if ($this->isWeekend()) {
            return true;
        }

        if (in_array($this->start->format('Y-m-d'), $this->holidays)) {
            return true;
        }

        if (in_array($this->start->format('*-m-d'), $this->holidays)) {
            return true;
        }

        return false;
    }
}

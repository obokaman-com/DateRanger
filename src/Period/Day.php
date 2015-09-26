<?php

namespace DateRanger\Period;

use DateRanger\PeriodBase;

final class Day extends PeriodBase
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
        '*-12-06', // Dia de la Constitución
        '*-12-08', // Immaculada Concepción
        '*-12-25', // Navidad
        '*-12-26', // San Esteban

        '2015-04-03', // Viernes Santo
        '2015-04-06' // Lunes de Pascua
    ];

    public function __construct(\DateTimeInterface $day)
    {
        $date        = $this->forceImmutableDate($day);
        $this->start = $date->setTime(0, 0, 0);
        $this->end   = $date->setTime(23, 59, 59);
        $this->dates = [$date];
    }

    public function isWeekend()
    {
        return in_array($this->start()->format('w'), $this->weekend);
    }

    public function isHoliday()
    {
        if ($this->isWeekend())
        {
            return true;
        }

        if (in_array($this->start->format('Y-m-d'), $this->holidays))
        {
            return true;
        }

        if (in_array($this->start->format('*-m-d'), $this->holidays))
        {
            return true;
        }

        return false;
    }

    /**
     * It's unnecessary defining this method. It's here only to allow IDE type hinting.
     *
     * @return Day
     */
    public function current()
    {
        return current($this->dates);
    }
}

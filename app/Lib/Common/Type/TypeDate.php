<?php

declare(strict_types=1);

namespace App\Lib\Common\Type;
use Carbon\Carbon;

class TypeDate
{
    private int $year = 0;
    private int $month = 0;
    private int $day = 0;
    private WeekDayType $weekDayType;
    private bool $withWeekDay = false;
}

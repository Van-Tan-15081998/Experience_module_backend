<?php

declare(strict_types=1);

namespace App\Lib\Common\Type;

use MyCLabs\Enum\Enum;

class WeekDayType extends Enum
{
    public const SUNDAY = [0, 'Th 2', 'Ngày thứ hai'];
    public const MONDAY = [1, 'Th 3', 'Ngày thứ ba'];
    public const TUESDAY = [2, 'Th 4', 'Ngày thứ tư'];
    public const WEDNESDAY = [3, 'Th 5', 'Ngày thứ năm'];
    public const THURSDAY = [4, 'Th 6', 'Ngày thứ sáu'];
    public const FRIDAY = [5, 'Th 7', 'Ngày thứ bảy'];
    public const SATURDAY = [6, 'CN', 'Ngày chủ nhật'];

    public function getId(): int
    {
        return $this->value[0];
    }

    public function getShortString(): string
    {
        return $this->value[1];
    }

    public function getFullString(): string
    {
        return $this->value[2];
    }
}

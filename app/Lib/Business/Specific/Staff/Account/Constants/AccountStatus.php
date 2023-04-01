<?php

namespace App\Lib\Business\Specific\Staff\Account\Constants;

use MyCLabs\Enum\Enum;

class AccountStatus extends Enum
{
    public const VALID = ['staff_account_status_valid'];
    public const INVALID = ['staff_account_status_invalid'];

    public function getProcessingKey(): string
    {
        return $this->value[0];
    }
}

<?php

namespace App\Util;

use App\Lib\Business\Constants\CommonErrorCode;
use App\Lib\WebCommon\Helpers\ResponseStatus;

class ResponseStatusHelper
{
    public static function toList(?ResponseStatus $status): ?array
    {
        $statuses = null;

        if(isset($status)) {
            $statuses = array();
            $statuses[] = $status;
        }

        return $statuses;
    }

    public static function createUnauthorized(bool $isInitDisplay=false): ResponseStatus
    {
        $message = $isInitDisplay ?
            'admin_common_message.common_err_role_init_unauthorized_00-13-000001' :
            'admin_common_message.common_err_role_unauthorized_00-13-000002';

        return ResponseStatus::createErrorStatus(
            CommonErrorCode::E00000000001()->getCode(),
            CommonErrorCode::E00000000001()->getDescription(),
            $message
        );
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

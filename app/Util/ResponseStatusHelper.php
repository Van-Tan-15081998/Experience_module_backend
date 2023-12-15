<?php

namespace App\Util;

use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\WebCommon\Constants\MessageType;
use App\Lib\WebCommon\Helpers\ResponseStatus;

class ResponseStatusHelper
{
    public static function toList(?ResponseStatus $status): ?DreamerTypeList
    {
        $statuses = null;

        if(isset($status)) {
            $statuses = new DreamerTypeList();
            $statuses->add($status);
        }

        return $statuses;
    }

    public static function createUnauthorized(bool $isInitDisplay=false): ResponseStatus
    {
        $message = $isInitDisplay ?
            'admin_common_message.common_err_role_init_unauthorized_00-13-000001' :
            'admin_common_message.common_err_role_unauthorized_00-13-000002';

        return ResponseStatus::createErrorStatus(
            DreamerCommonErrorCode::E00000000001()->getCode(),
            DreamerCommonErrorCode::E00000000001()->getDescription(),
            $message
        );
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }

    public static function createSaveSuccessful(): ResponseStatus
    {
        return ResponseStatus::createSuccessfulStatus(
            MessageType::INFO(),
            'Đã đăng ký'
        );
    }

    public static function createUpdateSuccessful(): ResponseStatus
    {
        return ResponseStatus::createSuccessfulStatus(
            MessageType::INFO(),
            'Đã cập nhật'
        );
    }

    public static function createUpdateForDeleteSuccessful(): ResponseStatus
    {
        return ResponseStatus::createSuccessfulStatus(
            MessageType::INFO(),
            'Đã xóa'
        );
    }
}

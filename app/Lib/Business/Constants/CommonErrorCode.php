<?php

namespace App\Lib\Business\Constants;

use MyCLabs\Enum\Enum;

class CommonErrorCode extends Enum
{
    public const E00000000001 = ['E00000000001', 'Lỗi [E00000000001] xảy ra!'];
    public const E00000000002 = ['E00000000002', 'Lỗi [E00000000002] xảy ra!'];
    public const E00000000003 = ['E00000000003', 'Lỗi [E00000000003] xảy ra!'];
    public const E00000000004 = ['E00000000004', 'Lỗi [E00000000004] xảy ra!'];
    public const E00000000005 = ['E00000000005', 'Lỗi [E00000000005] xảy ra!'];
    public const E00000000006 = ['E00000000006', 'Lỗi [E00000000006] xảy ra!'];
    public const E00000000007 = ['E00000000007', 'Lỗi [E00000000007] xảy ra!'];
    public const E00000000008 = ['E00000000008', 'Lỗi [E00000000008] xảy ra!'];
    public const E00000000009 = ['E00000000009', 'Lỗi [E00000000009] xảy ra!'];
    public const E00000000010 = ['E00000000010', 'Lỗi [E00000000010] xảy ra!'];

    public function getCode() {
        return $this->value[0];
    }

    public function getDescription() {
        return $this->value[1];
    }
}

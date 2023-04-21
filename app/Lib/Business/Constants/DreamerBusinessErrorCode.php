<?php

namespace App\Lib\Business\Constants;

use MyCLabs\Enum\Enum;

class DreamerBusinessErrorCode extends Enum
{
    //----------------------------------------------------------------------
    // Lỗi liên quan đến Business
    //----------------------------------------------------------------------
    /*
     * Lỗi:
     * */
    /* */
    /* */


    //----------------------------------------------------------------------
    // Lỗi liên quan đến Business
    //----------------------------------------------------------------------
    /*
     * Tài khoản
     * */
    /* Thông tin người dùng không khớp */
    public const E02101001001 = ['E02101001001', 'Thông tin người dùng không khớp'];
    /* Tài khoản không hợp lệ */
    public const E02101001002 = ['E02101001002', 'Tài khoản không hợp lệ'];

    //----------------------------------------------------------------------
    // Lỗi liên quan đến Business
    //----------------------------------------------------------------------
    /*
     * Lỗi:
     * */
    /* */
    /* */


    //----------------------------------------------------------------------
    // Lỗi liên quan đến Business
    //----------------------------------------------------------------------
    /*
     * Lỗi:
     * */
    /* */
    /* */

    public function getCode() {
        return $this->value[0];
    }

    public function getDescription() {
        return $this->value[1];
    }
}

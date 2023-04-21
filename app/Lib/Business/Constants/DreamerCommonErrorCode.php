<?php

namespace App\Lib\Business\Constants;

use MyCLabs\Enum\Enum;

class DreamerCommonErrorCode extends Enum
{

    //----------------------------------------------------------------------
    // InvalidParameterError
    //----------------------------------------------------------------------
    /*
     * Lỗi dữ liệu không hợp lệ (InvalidParameterError)
     * */
    /* Lỗi dữ liệu không hợp lệ (InvalidParameterError) */
    public const E00000000001 = ['E00000000001', 'Lỗi dữ liệu không hợp lệ (InvalidParameterError)'];
    /* Không tìm thấy dữ liệu mục tiêu */
    public const E00000000002 = ['E00000000002', 'Không tìm thấy dữ liệu mục tiêu'];
    /* Không thể lấy các mục phổ biến trên màn hình (_____Chưa xác định) */
    public const E00000000003 = ['E00000000003', 'Không thể lấy các mục phổ biến trên màn hình'];
    /* Dữ liệu không thống nhất (không đồng nhất hay không nhất quán) */
    public const E00000000004 = ['E00000000004', 'Dữ liệu không thống nhất'];
    /* Không được phép (_____Chưa xác định) */
    public const E00000000005 = ['E00000000005', 'Không được phép'];
    /* Phiên bản hệ thống không khớp */
    public const E00000000006 = ['E00000000006', 'Phiên bản hệ thống không khớp'];
    /* Đang bảo trì hệ thống */
    public const E00000000007 = ['E00000000007', 'Đang bảo trì hệ thống'];
    /* Không lấy được dữ liệu liên quan */
    public const E00000000008 = ['E00000000008', 'Không lấy được dữ liệu liên quan'];


    //----------------------------------------------------------------------
    // Lỗi thao tác tệp (File)
    //----------------------------------------------------------------------
    /*
     * Lỗi thao tác tệp
     * */
    /* Không thể mở tập tin, v.v. */
    public const E00001000001 = ['E00001000001', 'Lỗi thao tác tệp'];
    /* Đường dẫn tệp không chính xác (Chẳng hạn như chỉ định đường dẫn thư mục) */
    public const E00001000002 = ['E00001000002', 'Đường dẫn tệp không hợp lệ'];
    /* Định dạng tập tin không hợp lệ */
    public const E00001000003 = ['E00001000003', 'Định dạng tập tin không hợp lệ'];
    /* Tập tin không tìm thấy */
    public const E00001000004 = ['E00001000004', 'Tập tin không tìm thấy'];
    /* Tập tin đã tồn tại */
    public const E00001000005 = ['E00001000005', 'Tập tin đã tồn tại'];


    //----------------------------------------------------------------------
    // Database
    //----------------------------------------------------------------------
    /*
     * Lỗi Cơ sở dữ liệu
     * */
    /* Lỗi kết nối cơ sở dữ liệu */
    public const F00003000001 = ['F00003000001', 'Lỗi kết nối cơ sở dữ liệu'];
    /* (_____Chưa xác định) */
    public const F00003000002 = ['F00003000002', 'Chưa xác định'];
    /* (_____Chưa xác định) */
    public const F00003000003 = ['F00003000003', 'Chưa xác định'];
    /* (_____Chưa xác định) */
    public const F00003000004 = ['F00003000004', 'Chưa xác định'];
    /* (_____Chưa xác định) */
    public const F00003000005 = ['F00003000005', 'Chưa xác định'];
    /* (_____Chưa xác định) */
    public const F00003000006 = ['F00003000006', 'Chưa xác định'];
    /* Lỗi Insert dữ liệu*/
    public const E00003000007 = ['E00003000007', 'Không thể đăng ký dữ liệu khi insert'];
    /* Các ngoại lệ resource data khác */
    public const E00003000008 = ['E00003000008', 'Lỗi không xác định xảy ra trong quá trình xử lý truy cập dữ liệu'];
    /* Vượt quá phạm vi giá trị có thể xử lý */
    public const E00003000009 = ['E00003000009', 'Vượt quá phạm vi giá trị có thể xử lý'];
    /* Không thể thực thi SHELL (_____Chưa xác định) */
    public const F00003000010 = ['F00003000010', 'Không thể thực thi SHELL'];
    /* Tệp cần sao chép không tồn tại (_____Chưa xác định) */
    public const E00003000011 = ['E00003000011', 'Tệp cần sao chép không tồn tại'];
    /* Không thể truy cập tệp được sao chép (ví dụ: không có quyền đọc) (_____Chưa xác định) */
    public const E00003000012 = ['E00003000012', 'Không thể truy cập tệp được sao chép'];
    /* */


    //----------------------------------------------------------------------
    // Uỷ quyền / Xác thực
    //----------------------------------------------------------------------
    /*
     * Lỗi Ủy quyền và Xác thực người dùng
     * */
    /* Lỗi xác thực */
    public const E00900000001 = ['E00900000001', 'Lỗi xác thực'];
    /* Các lỗi khác trong quá trình xác thực */
    public const E00900000002 = ['E00900000002', 'Lỗi trong quá trình xác thực'];
    /* Lỗi xác thực: Không thể lấy được thông tin người dùng. */
    public const E00900000003 = ['E00900000003', 'Không thể lấy thông tin người dùng'];
    /* Lỗi ủy quyền */
    public const E00900000004 = ['E00900000004', 'Lỗi ủy quyền'];
    /* Lỗi Xác thực đăng nhập: Thông tin đăng nhập không chính xác */
    public const E00900001001 = ['E00900001001', 'Thông tin đăng nhập không chính xác'];
    /* Xác thực đăng nhập: Đã khóa. */
    public const E00900001002 = ['E00900001002', 'Thông tin đăng nhập đã bị khóa'];

    /* (_____Chưa xác định) */
    public const E00900001003 = ['E00900001003', 'Chưa xác định'];
    /* (_____Chưa xác định) */
    public const E00900001004 = ['E00900001004', 'Chưa xác định'];

    /* Xác thực đăng nhập: Bạn không có quyền truy cập */
    public const E00900001005 = ['E00900001005', 'Bạn không có quyền truy cập'];
    /* Xác thực đăng nhập: Đã tìm thấy nhiều thông tin tài khoản. */
    public const E00900001006 = ['E00900001006', 'Đã tìm thấy nhiều thông tin tài khoản'];
    /* Xác thực đăng nhập: Lỗi khác */
    public const E00900001007 = ['E00900001007', 'Lỗi khác'];


    /*
     * Lỗi Phổ biến cho các Client module
     * */
    /* Lỗi xác thực */
    public const F00008000001 = ['F00008000001', 'Lỗi xác thực'];
    /* Tham số không hợp lệ */
    public const F00008000002 = ['F00008000002', 'Tham số không hợp lệ'];
    /* Đường dẫn được chỉ định không tồn tại */
    public const E00008000003 = ['E00008000003', 'Đường dẫn được chỉ định không tồn tại'];
    /* Một đường dẫn có cùng tên tồn tại */
    public const E00008000004 = ['E00008000004', 'Một đường dẫn có cùng tên tồn tại'];
    /* Lỗi hoạt động của máy khách (Client) */
    public const F00008000005 = ['F00008000005', 'Lỗi hoạt động của máy khách (Client)'];
    /* Truy cập bị từ chối */
    public const F00008000006 = ['F00008000006', 'Truy cập bị từ chối'];


    /*
     * Lỗi
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

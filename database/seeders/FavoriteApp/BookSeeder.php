<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorite_app__books')->insert([
            [
                'book_id'                   =>  1,
                'title'                     =>  'Cách nghĩ để thành công',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  2,
                'title'                     =>  'Cuộc sống không giới hạn',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  3,
                'title'                     =>  'Người giàu có nhất thành Babylon',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  4,
                'title'                     =>  'Quẳng gánh lo đi mà vui sống',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  5,
                'title'                     =>  'Tốc độ của niềm tin',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  6,
                'title'                     =>  'Lời Nói Có Đáng Tin',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  7,
                'title'                     =>  'Từ Tốt Đến Vĩ Đại',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  8,
                'title'                     =>  'Những Kẻ Xuất Chúng',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  9,
                'title'                     =>  'Lược Sử Kinh Tế Học',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  10,
                'title'                     =>  'Trên Hành Trình Tự Học',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  11,
                'title'                     =>  'Thư Gửi Con',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  12,
                'title'                     =>  'NGẪM CHUYỆN XƯA NAY',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  13,
                'title'                     =>  'Tên Ngài Là Thương Xót',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  14,
                'title'                     =>  'Gia Định Là Nhớ Sài Gòn Là Thương',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  15,
                'title'                     =>  'SÀI GÒN MỘT THUỞ - DÂN ÔNG TẠ ĐÓ',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  16,
                'title'                     =>  'Thiên Nga Đen',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  17,
                'title'                     =>  'Cho Đi Và Nhận Lại - Nghệ Thuật Xây Dựng Mối Quan Hệ Nơi Công Sở',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  18,
                'title'                     =>  'Ổn Định Hay Tự Do',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  19,
                'title'                     =>  'Hành Tinh Của Một Kẻ Nghĩ Nhiều',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  20,
                'title'                     =>  'Tôi Quyết Định Sống Cho Chính Tôi',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ]
            ]);
    }
}

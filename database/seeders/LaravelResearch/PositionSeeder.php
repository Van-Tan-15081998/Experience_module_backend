<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__positions')->insert([
            [
                'position_id' => 1,
                'name' => 'Trưởng phòng Kinh doanh',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 2,
                'name' => 'Chuyên viên kinh doanh',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 3,
                'name' => 'Chuyên viên tư vấn',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 4,
                'name' => 'Chuyên viên hỗ trợ khách hàng',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 5,
                'name' => 'Trưởng phòng Kế toán',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 6,
                'name' => 'Kế toán trưởng',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 7,
                'name' => 'Kế toán viên',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 8,
                'name' => 'Kế toán viên',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 9,
                'name' => 'Trưởng phòng Nhân sự',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 10,
                'name' => 'Chuyên viên nhân sự',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 11,
                'name' => 'Chuyên viên tuyển dụng',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 12,
                'name' => 'Chuyên viên quản lý chấm công',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 13,
                'name' => 'Trưởng phòng Công nghệ thông tin',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 14,
                'name' => 'Chuyên viên công nghệ thông tin',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 15,
                'name' => 'Chuyên viên phần mềm',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 16,
                'name' => 'Chuyên viên mạng',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 17,
                'name' => 'Trưởng phòng Marketing',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 18,
                'name' => 'Chuyên viên marketing',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 19,
                'name' => 'Chuyên viên quảng cáo',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 20,
                'name' => 'Chuyên viên phân tích thị trường',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 21,
                'name' => 'Trưởng phòng Đầu tư',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 22,
                'name' => 'Chuyên viên nghiên cứu',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 23,
                'name' => 'Chuyên viên phát triển sản phẩm',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 24,
                'name' => 'Chuyên viên chuẩn bị dự án',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 25,
                'name' => 'Trưởng phòng Đối ngoại',
                'description' => '',
                'is_manager' => true
            ],
            [
                'position_id' => 26,
                'name' => 'Chuyên viên liên lạc với đối tác',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 27,
                'name' => 'Chuyên viên xuất nhập khẩu',
                'description' => '',
                'is_manager' => false
            ],
            [
                'position_id' => 28,
                'name' => 'Chuyên viên hợp tác quốc tế',
                'description' => '',
                'is_manager' => false
            ],
        ]);
    }
}

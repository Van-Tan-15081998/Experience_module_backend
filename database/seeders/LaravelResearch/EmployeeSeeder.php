<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__employees')->insert([
            [
                'employee_id' => 1,
                'full_name' => 'Trần Văn M',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'tranvanm@gmail.com',
                'phone_number' => '_',
                'department_code' => 1,
                'department_name' => ''
            ],
            [
                'employee_id' => 2,
                'full_name' => 'Đỗ Văn N',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'dovann@gmail.com',
                'phone_number' => '_',
                'department_code' => 1,
                'department_name' => ''
            ],
            [
                'employee_id' => 3,
                'full_name' => 'Nguyễn Thị O',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenthio@gmail.com',
                'phone_number' => '_',
                'department_code' => 1,
                'department_name' => ''
            ],
            [
                'employee_id' => 4,
                'full_name' => 'Hồ Thị P',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'hothip@gmail.com',
                'phone_number' => '_',
                'department_code' => 1,
                'department_name' => ''
            ],
            [
                'employee_id' => 5,
                'full_name' => 'Nguyễn Văn A',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenvana@gmail.com',
                'phone_number' => '_',
                'department_code' => 2,
                'department_name' => ''
            ],
            [
                'employee_id' => 6,
                'full_name' => 'Trần Thị B',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'tranthib@gmail.com',
                'phone_number' => '_',
                'department_code' => 2,
                'department_name' => ''
            ],
            [
                'employee_id' => 7,
                'full_name' => 'Lê Văn C',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'levanc@gmail.com',
                'phone_number' => '_',
                'department_code' => 2,
                'department_name' => ''
            ],
            [
                'employee_id' => 8,
                'full_name' => 'Đỗ Thị D',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'dothid@gmail.com',
                'phone_number' => '_',
                'department_code' => 2,
                'department_name' => ''
            ],
            [
                'employee_id' => 9,
                'full_name' => 'Hoàng Thị E',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'hoangthie@gmail.com',
                'phone_number' => '_',
                'department_code' => 3,
                'department_name' => ''
            ],
            [
                'employee_id' => 10,
                'full_name' => 'Nguyễn Minh F',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenminhf@gmail.com',
                'phone_number' => '_',
                'department_code' => 3,
                'department_name' => ''
            ],
            [
                'employee_id' => 11,
                'full_name' => 'Lê Thị G',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'lethig@gmail.com',
                'phone_number' => '_',
                'department_code' => 3,
                'department_name' => ''
            ],
            [
                'employee_id' => 12,
                'full_name' => 'Vũ Thị H',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'vuthih@gmail.com',
                'phone_number' => '_',
                'department_code' => 3,
                'department_name' => ''
            ],
            [
                'employee_id' => 13,
                'full_name' => 'Hoàng Văn U',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'hoangvanu@gmail.com',
                'phone_number' => '_',
                'department_code' => 4,
                'department_name' => ''
            ],
            [
                'employee_id' => 14,
                'full_name' => 'Lê Văn V',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'levanv@gmail.com',
                'phone_number' => '_',
                'department_code' => 4,
                'department_name' => ''
            ],
            [
                'employee_id' => 15,
                'full_name' => 'Nguyễn Thị W',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenthiw@gmail.com',
                'phone_number' => '_',
                'department_code' => 4,
                'department_name' => ''
            ],
            [
                'employee_id' => 16,
                'full_name' => 'Trần Thị X',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'tranthix@gmail.com',
                'phone_number' => '_',
                'department_code' => 4,
                'department_name' => ''
            ],
            [
                'employee_id' => 17,
                'full_name' => 'Đinh Văn I',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'dinhvani@gmail.com',
                'phone_number' => '_',
                'department_code' => 5,
                'department_name' => ''
            ],
            [
                'employee_id' => 18,
                'full_name' => 'Phạm Thị J',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'phamthij@gmail.com',
                'phone_number' => '_',
                'department_code' => 5,
                'department_name' => ''
            ],
            [
                'employee_id' => 19,
                'full_name' => 'Lê Văn K',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'levank@gmail.com',
                'phone_number' => '_',
                'department_code' => 5,
                'department_name' => ''
            ],
            [
                'employee_id' => 20,
                'full_name' => 'Nguyễn Thị L',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenthil@gmail.com',
                'phone_number' => '_',
                'department_code' => 5,
                'department_name' => ''
            ],
            [
                'employee_id' => 21,
                'full_name' => 'Nguyễn Văn CC',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenvancc@gmail.com',
                'phone_number' => '_',
                'department_code' => 6,
                'department_name' => ''
            ],
            [
                'employee_id' => 22,
                'full_name' => 'Trần Văn DD',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'tranvandd@gmail.com',
                'phone_number' => '_',
                'department_code' => 6,
                'department_name' => ''
            ],
            [
                'employee_id' => 23,
                'full_name' => 'Lê Thị EE',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'lethiee@gmail.com',
                'phone_number' => '_',
                'department_code' => 6,
                'department_name' => ''
            ],
            [
                'employee_id' => 24,
                'full_name' => 'Đỗ Văn FF',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'dovanff@gmail.com',
                'phone_number' => '_',
                'department_code' => 6,
                'department_name' => ''
            ],
            [
                'employee_id' => 25,
                'full_name' => 'Hoàng Văn SS',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'hoangvanss@gmail.com',
                'phone_number' => '_',
                'department_code' => 7,
                'department_name' => ''
            ],
            [
                'employee_id' => 26,
                'full_name' => 'Nguyễn Văn TT',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'nguyenthitt@gmail.com',
                'phone_number' => '_',
                'department_code' => 7,
                'department_name' => ''
            ],
            [
                'employee_id' => 27,
                'full_name' => 'Trần Thị UU',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'tranthiuu@gmail.com',
                'phone_number' => '_',
                'department_code' => 7,
                'department_name' => ''
            ],
            [
                'employee_id' => 28,
                'full_name' => 'Lê Thị VV',
                'birthday' => '2023-01-30',
                'gender_code' => 0,
                'email_address' => 'lethivv@gmail.com',
                'phone_number' => '_',
                'department_code' => 7,
                'department_name' => ''
            ],
        ]);
    }
}

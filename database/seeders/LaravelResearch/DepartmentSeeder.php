<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__departments')->insert([
            [
                'department_id' => 1,
                'name' => 'Phòng kinh doanh',
                'description' => 'Nhiệm vụ chính của phòng này là phát triển và duy trì các mối quan hệ với khách hàng, đảm bảo sự hài lòng của khách hàng và tìm kiếm các cơ hội mới để mở rộng kinh doanh.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 2,
                'name' => 'Phòng kế toán',
                'description' => 'Nhiệm vụ chính của phòng này là quản lý các hoạt động tài chính của công ty, bao gồm việc ghi nhận, chứng từ và tài khoản, và cung cấp thông tin tài chính cho các nhà quản lý.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 3,
                'name' => 'Phòng nhân sự',
                'description' => 'Nhiệm vụ chính của phòng này là quản lý và hỗ trợ nhân viên trong công ty, bao gồm việc tuyển dụng, đào tạo, đánh giá và điều hành các chính sách lương và phúc lợi.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 4,
                'name' => 'Phòng công nghệ thông tin',
                'description' => 'Phòng công nghệ thông tin: Nhiệm vụ chính của phòng này là hỗ trợ và quản lý hệ thống thông tin của công ty, bao gồm việc phát triển và bảo trì các hệ thống máy tính và mạng.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 5,
                'name' => 'Phòng marketing',
                'description' => 'Phòng marketing: Nhiệm vụ chính của phòng này là quảng bá và tiếp thị sản phẩm và dịch vụ của công ty, bao gồm việc phân tích thị trường và xác định nhu cầu của khách hàng, và tạo ra các chiến lược và kế hoạch marketing tốt nhất để đạt được mục tiêu kinh doanh.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 6,
                'name' => 'Phòng đầu tư',
                'description' => 'Nhiệm vụ chính của phòng này là phân tích và quản lý các dự án đầu tư của công ty, bao gồm việc tìm kiếm và đánh giá các cơ hội đầu tư, và quản lý vốn đầu tư của công ty.',
                'manager_code' => 0,
            ],
            [
                'department_id' => 7,
                'name' => 'Phòng đối ngoại',
                'description' => 'Nhiệm vụ chính của phòng này là quản lý và duy trì các mối quan hệ với các đối tác nước ngoài, bao gồm việc giao dịch và hợp tác kinh doanh.',
                'manager_code' => 0,
            ],
        ]);
    }
}

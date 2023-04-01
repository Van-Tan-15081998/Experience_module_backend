<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffAccountStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('staff_account_statuses')->insert([
            [
                'staff_account_status_id'   => 1,
                'processing_key'    =>  'staff_account_status_valid',
                'name'              =>  'Trạng thái nhân viên hợp lệ'
            ],
            [
                'staff_account_status_id'   => 2,
                'processing_key'    =>  'staff_account_status_invalid',
                'name'              =>  'Trạng thái nhân viên không hợp lệ'
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('staff_accounts')->insert([
            [
                'staff_account_id'       => 1,
                'login_id'          => 'systemmanager',
                'password'      => '$2y$10$kK0zWT5VtK8eOyBHJLQs4eVkBJQvW287B61L8GN9Cu9I1Bn.yHB8m',
                'last_name'     => 'Le',
                'first_name'    => 'Van Tan',
                'email_address' => 'levantan@gmail.com',
                'staff_account_status_code' => 1
            ],
        ]);
    }
}

<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterStaffAccountRoleGroupAllocation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__staff_account_role_group_allocations')->insert([
            [
                'staff_account_role_group_allocation_id'    => 1,
                'staff_account_id'                          => 1,
                'role_group_id'                             => 1
            ]
        ]);
    }
}

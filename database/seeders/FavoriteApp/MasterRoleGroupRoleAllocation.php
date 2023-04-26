<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleGroupRoleAllocation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__role_group_role_allocations')->insert([
            [
                'role_group_role_allocation_id'     => 1,
                'role_group_id'                     => 1,
                'role_id'                           => 1
            ],
            [
                'role_group_role_allocation_id'     => 2,
                'role_group_id'                     => 2,
                'role_id'                           => 2
            ]
        ]);
    }
}

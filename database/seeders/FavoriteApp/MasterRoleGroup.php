<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleGroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__role_groups')->insert([
            [
                'role_group_id'     => 1,
                'name'              => 'Book Role Group',
                'is_invalid'        => false,
                'sequence'          => 0
            ],
            [
                'role_group_id'     => 2,
                'name'              => 'Subject Role Group',
                'is_invalid'        => false,
                'sequence'          => 0
            ]
        ]);
    }
}

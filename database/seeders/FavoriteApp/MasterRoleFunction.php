<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleFunction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__role_functions')->insert([
            [
                'role_function_id'      => 1,
                'role_id'               => 1,
                'function_id'           => 1,
                'is_browser'            => 1,
                'is_registration'       => 0,
                'is_edit'               => 0,
                'is_delete'             => 1,
                'is_upload'             => 0,
                'is_download'           => 0
            ],
            [
                'role_function_id'      => 2,
                'role_id'               => 1,
                'function_id'           => 2,
                'is_browser'            => 1,
                'is_registration'       => 1,
                'is_edit'               => 1,
                'is_delete'             => 0,
                'is_upload'             => 0,
                'is_download'           => 0
            ]
        ]);
    }
}

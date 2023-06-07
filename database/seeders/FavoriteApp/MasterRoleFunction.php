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
            // Book
            [
                'role_function_id'      => 1,
                'role_id'               => 1,
                'function_id'           => 1,
                'is_browse'            => 1,
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
                'is_browse'            => 1,
                'is_registration'       => 1,
                'is_edit'               => 1,
                'is_delete'             => 0,
                'is_upload'             => 0,
                'is_download'           => 0
            ],

            // Subject
            [
                'role_function_id'      => 3,
                'role_id'               => 2,
                'function_id'           => 3,
                'is_browse'            => 1,
                'is_registration'       => 0,
                'is_edit'               => 0,
                'is_delete'             => 1,
                'is_upload'             => 0,
                'is_download'           => 0
            ],
            [
                'role_function_id'      => 4,
                'role_id'               => 2,
                'function_id'           => 4,
                'is_browse'            => 1,
                'is_registration'       => 1,
                'is_edit'               => 1,
                'is_delete'             => 0,
                'is_upload'             => 0,
                'is_download'           => 0
            ],

            // Knowledge Article
            [
                'role_function_id'      => 5,
                'role_id'               => 3,
                'function_id'           => 5,
                'is_browse'            => 1,
                'is_registration'       => 0,
                'is_edit'               => 0,
                'is_delete'             => 1,
                'is_upload'             => 0,
                'is_download'           => 0
            ],
            [
                'role_function_id'      => 6,
                'role_id'               => 3,
                'function_id'           => 6,
                'is_browse'            => 1,
                'is_registration'       => 1,
                'is_edit'               => 1,
                'is_delete'             => 0,
                'is_upload'             => 0,
                'is_download'           => 0
            ],

            // Knowledge Article Content Unit
            [
                'role_function_id'      => 7,
                'role_id'               => 4,
                'function_id'           => 7,
                'is_browse'            => 1,
                'is_registration'       => 0,
                'is_edit'               => 0,
                'is_delete'             => 1,
                'is_upload'             => 0,
                'is_download'           => 0
            ],
            [
                'role_function_id'      => 8,
                'role_id'               => 4,
                'function_id'           => 8,
                'is_browse'            => 1,
                'is_registration'       => 1,
                'is_edit'               => 1,
                'is_delete'             => 0,
                'is_upload'             => 0,
                'is_download'           => 0
            ]
        ]);
    }
}

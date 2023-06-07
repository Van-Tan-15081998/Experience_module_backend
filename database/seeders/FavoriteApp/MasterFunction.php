<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterFunction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__functions')->insert([
            // Book
            [
                'function_id'           => 1,
                'parent_function_id'    => 0,
                'name'                  => 'Book List - Function',
                'screen_name'           => 'Book List',
                'screen_id'             => '80000001',
                'sequence'              => 1
            ],
            [
                'function_id'           => 2,
                'parent_function_id'    => 1,
                'name'                  => 'Book Detail - Function',
                'screen_name'           => 'Book Detail',
                'screen_id'             => '80000002',
                'sequence'              => 1
            ],

            // Subject
            [
                'function_id'           => 3,
                'parent_function_id'    => 0,
                'name'                  => 'Subject List - Function',
                'screen_name'           => 'Subject List',
                'screen_id'             => '80000003',
                'sequence'              => 1
            ],
            [
                'function_id'           => 4,
                'parent_function_id'    => 3,
                'name'                  => 'Subject Detail - Function',
                'screen_name'           => 'Subject Detail',
                'screen_id'             => '80000004',
                'sequence'              => 1
            ],

            // Knowledge Article
            [
                'function_id'           => 5,
                'parent_function_id'    => 0,
                'name'                  => 'Knowledge Article List - Function',
                'screen_name'           => 'Knowledge Article List',
                'screen_id'             => '80000005',
                'sequence'              => 1
            ],
            [
                'function_id'           => 6,
                'parent_function_id'    => 5,
                'name'                  => 'Knowledge Article Detail - Function',
                'screen_name'           => 'Knowledge Article Detail',
                'screen_id'             => '80000006',
                'sequence'              => 1
            ],

            // Knowledge Article Content Unit
            [
                'function_id'           => 7,
                'parent_function_id'    => 0,
                'name'                  => 'Knowledge Article Content Unit List - Function',
                'screen_name'           => 'Knowledge Article Content Unit List',
                'screen_id'             => '80000007',
                'sequence'              => 1
            ],
            [
                'function_id'           => 8,
                'parent_function_id'    => 5,
                'name'                  => 'Knowledge Article Content Unit Detail - Function',
                'screen_name'           => 'Knowledge Article Content Unit Detail',
                'screen_id'             => '80000008',
                'sequence'              => 1
            ]

        ]);
    }
}

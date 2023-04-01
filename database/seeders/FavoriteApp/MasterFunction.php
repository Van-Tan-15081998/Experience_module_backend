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
            ]
            ]);
    }
}

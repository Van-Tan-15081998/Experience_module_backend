<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master__roles')->insert([
            [
                'role_id'       => 1,
                'name'          => 'Book Role Master',
                'sequence'      => 0
            ],
            [
                'role_id'       => 2,
                'name'          => 'Subject Role Master',
                'sequence'      => 0
            ]
        ]);
    }
}

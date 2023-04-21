<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorite_app__languages')->insert([
            [
                'language_id'      =>  1,
                'name'              =>  'Tiếng Việt',
            ],
            [
                'language_id'      =>  2,
                'name'              =>  'Tiếng Anh',
            ],
            [
                'language_id'      =>  3,
                'name'              =>  'Tiếng Pháp',
            ],
            [
                'language_id'      =>  4,
                'name'              =>  'Tiếng Nga',
            ],
            [
                'language_id'      =>  5,
                'name'              =>  'Tiếng Nhật',
            ],
        ]);
    }
}

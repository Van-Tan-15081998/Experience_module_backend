<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorite_app__books')->insert([
            [
                'book_id'                   =>  1,
                'title'                     =>  'Cách nghĩ để thành công',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  2,
                'title'                     =>  'Cuộc sống không giới hạn',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  3,
                'title'                     =>  'Người giàu có nhất thành Babylon',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  4,
                'title'                     =>  'Quẳng gánh lo đi mà vui sống',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ],
            [
                'book_id'                   =>  5,
                'title'                     =>  'Tốc độ của niềm tin',
                'author_code'               =>  0,
                'publisher_code'            =>  0,
                'category_code'             =>  0,
            ]
            ]);
    }
}

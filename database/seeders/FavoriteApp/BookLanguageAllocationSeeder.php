<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookLanguageAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorite_app__book_language_allocations')->insert([
            [
                'book_language_allocation_id'   =>  1,
                'book_id'                       =>  1,
                'language_id'                   =>  1,
            ],
            [
                'book_language_allocation_id'   =>  2,
                'book_id'                       =>  1,
                'language_id'                   =>  2,
            ],
            [
                'book_language_allocation_id'   =>  3,
                'book_id'                       =>  1,
                'language_id'                   =>  3,
            ],
            [
                'book_language_allocation_id'   =>  4,
                'book_id'                       =>  2,
                'language_id'                   =>  2,
            ],
            [
                'book_language_allocation_id'   =>  5,
                'book_id'                       =>  2,
                'language_id'                   =>  3,
            ],
            [
                'book_language_allocation_id'   =>  6,
                'book_id'                       =>  2,
                'language_id'                   =>  4,
            ],
            [
                'book_language_allocation_id'   =>  7,
                'book_id'                       =>  3,
                'language_id'                   =>  3,
            ],
            [
                'book_language_allocation_id'   =>  8,
                'book_id'                       =>  3,
                'language_id'                   =>  4,
            ],
            [
                'book_language_allocation_id'   =>  9,
                'book_id'                       =>  3,
                'language_id'                   =>  5,
            ],
            [
                'book_language_allocation_id'   =>  10,
                'book_id'                       =>  4,
                'language_id'                   =>  2,
            ],
        ]);
    }
}

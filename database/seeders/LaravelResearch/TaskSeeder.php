<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__tasks')->insert(
            [
                'task_id' => 1,
                'name' => '',
                'description' => '',
                'status' => 0,
            ],
        );
    }
}

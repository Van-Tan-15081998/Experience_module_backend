<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__employee_tasks')->insert(
            [
                'employee_code' => 0,
                'task_code' => 0,
            ],
        );
    }
}

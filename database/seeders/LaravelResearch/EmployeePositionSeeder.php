<?php

namespace Database\Seeders\LaravelResearch;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laravel_research__employee_positions')->insert([
            [
                'employee_code' => 1,
                'position_code' => 1,
            ],
            [
                'employee_code' => 2,
                'position_code' => 2,
            ],
            [
                'employee_code' => 3,
                'position_code' => 3,
            ],
            [
                'employee_code' => 4,
                'position_code' => 4,
            ],
            [
                'employee_code' => 5,
                'position_code' => 5,
            ],
            [
                'employee_code' => 6,
                'position_code' => 6,
            ],
            [
                'employee_code' => 7,
                'position_code' => 7,
            ],
            [
                'employee_code' => 8,
                'position_code' => 8,
            ],
            [
                'employee_code' => 9,
                'position_code' => 9,
            ],
            [
                'employee_code' => 10,
                'position_code' => 10,
            ],
            [
                'employee_code' => 11,
                'position_code' => 11,
            ],
            [
                'employee_code' => 12,
                'position_code' => 12,
            ],
            [
                'employee_code' => 13,
                'position_code' => 13,
            ],
            [
                'employee_code' => 14,
                'position_code' => 14,
            ],
            [
                'employee_code' => 15,
                'position_code' => 15,
            ],
            [
                'employee_code' => 16,
                'position_code' => 16,
            ],
            [
                'employee_code' => 17,
                'position_code' => 17,
            ],
            [
                'employee_code' => 18,
                'position_code' => 18,
            ],
            [
                'employee_code' => 19,
                'position_code' => 19,
            ],
            [
                'employee_code' => 20,
                'position_code' => 20,
            ],
            [
                'employee_code' => 21,
                'position_code' => 21,
            ],
            [
                'employee_code' => 22,
                'position_code' => 22,
            ],
            [
                'employee_code' => 23,
                'position_code' => 23,
            ],
            [
                'employee_code' => 24,
                'position_code' => 24,
            ],
            [
                'employee_code' => 25,
                'position_code' => 25,
            ],
            [
                'employee_code' => 26,
                'position_code' => 26,
            ],
            [
                'employee_code' => 27,
                'position_code' => 27,
            ],
            [
                'employee_code' => 28,
                'position_code' => 28,
            ],
        ]);
    }
}

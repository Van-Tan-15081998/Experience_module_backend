<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\FavoriteApp\BookLanguageAllocationSeeder;
use Database\Seeders\FavoriteApp\BookSeeder;
use Database\Seeders\FavoriteApp\KnowledgeSeeder;
use Database\Seeders\FavoriteApp\LanguageSeeder;
use Database\Seeders\FavoriteApp\MasterFunction;
use Database\Seeders\FavoriteApp\MasterRole;
use Database\Seeders\FavoriteApp\MasterRoleFunction;
use Database\Seeders\FavoriteApp\MasterRoleGroup;
use Database\Seeders\FavoriteApp\MasterRoleGroupRoleAllocation;
use Database\Seeders\FavoriteApp\MasterStaffAccountRoleGroupAllocation;
use Database\Seeders\FavoriteApp\PublisherSeeder;
use Database\Seeders\LaravelResearch\DepartmentSeeder;
use Database\Seeders\LaravelResearch\EmployeePositionSeeder;
use Database\Seeders\LaravelResearch\EmployeeSeeder;
use Database\Seeders\LaravelResearch\PositionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            EmployeePositionSeeder::class,
            EmployeeSeeder::class,
            PositionSeeder::class,
            KnowledgeSeeder::class,
            BookSeeder::class,
            PublisherSeeder::class,
            BookLanguageAllocationSeeder::class,
            LanguageSeeder::class,

            StaffAccountSeeder::class,
            MasterFunction::class,
            MasterRole::class,
            MasterRoleFunction::class,
            MasterRoleGroup::class,
            MasterRoleGroupRoleAllocation::class,
            MasterStaffAccountRoleGroupAllocation::class,
            StaffAccountStatusSeeder::class
        ]);
    }
}

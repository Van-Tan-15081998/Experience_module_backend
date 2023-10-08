<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedDreamers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geolocate:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '(Auth:Van_Tan) Create Seeder from SQL file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('(Auth:Van_Tan) Seeding tables. Please waiting...:))');

        $files = [
            'kam__subject_branch_subject_allocations',
            'kam__subjects'
        ];

        DB::beginTransaction();

        foreach ($files as $file) {
            $path = __DIR__.'/../../../Databases/V_1/'.$file.'.sql';

            if(file_exists($path)) {
                $this->info('(Auth:Van_Tan) Seeding '.$file.'...');

                $h = fopen($path, mode: 'r');

                $content = fread($h, filesize($path));

//                DB::unprepared($content);
                DB::insert($content);

                DB::commit();

                $this->info('(Auth:Van_Tan) Content '.$content);

                fclose($h);
            } else {
                DB::rollBack();
                $this->error('(Auth:Van_Tan) File not found'. $path);
                return;
            }
        }

        return Command::SUCCESS;
    }
}

// php artisan migrate:refresh
// php artisan db:seed
// Chạy command này để import database từ file SQL: php artisan geolocate:seed

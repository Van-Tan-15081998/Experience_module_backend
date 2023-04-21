<?php

namespace Database\Seeders\FavoriteApp;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorite_app__publishers')->insert([
            [
                'publisher_id'      =>  1,
                'name'              =>  'Nhà xuất bản Hồng Đức',
            ],
            [
                'publisher_id'      =>  2,
                'name'              =>  'Nhà xuất bản Quân đội',
            ],
            [
                'publisher_id'      =>  3,
                'name'              =>  'Nhà xuất bản Kim Đồng',
            ],
            [
                'publisher_id'      =>  4,
                'name'              =>  'Nhà xuất bản Thanh niên',
            ],
            [
                'publisher_id'      =>  5,
                'name'              =>  'Nhà xuất bản Lao động',
            ],
            [
                'publisher_id'      =>  6,
                'name'              =>  'Nhà xuất bản Mỹ thuật',
            ],
            [
                'publisher_id'      =>  7,
                'name'              =>  'Nhà xuất bản Khoa học xã hội',
            ],
            [
                'publisher_id'      =>  8,
                'name'              =>  'Nhà xuất bản Khoa học và kỹ thuật',
            ],
            [
                'publisher_id'      =>  9,
                'name'              =>  'Nhà xuất bản Nông nghiệp',
            ],
            [
                'publisher_id'      =>  10,
                'name'              =>  'Nhà xuất bản Y học',
            ],
            [
                'publisher_id'      =>  11,
                'name'              =>  'Nhà xuất bản Từ điển bách khoa',
            ],
            [
                'publisher_id'      =>  12,
                'name'              =>  'Nhà xuất bản Thế giới',
            ],
            [
                'publisher_id'      =>  13,
                'name'              =>  'Nhà xuất bản Âm nhạc',
            ],
            [
                'publisher_id'      =>  14,
                'name'              =>  'Nhà xuất bản Văn học',
            ],
            [
                'publisher_id'      =>  15,
                'name'              =>  'Nhà xuất bản Văn hoá - Thông tin',
            ],
            [
                'publisher_id'      =>  16,
                'name'              =>  'Nhà xuất bản Giáo dục',
            ],
        ]);
    }
}

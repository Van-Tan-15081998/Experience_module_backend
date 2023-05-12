<?php

namespace Database\Seeders\KnowledgeArticle;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kam__subjects')->insert([
            // level 1
            [
                'subject_id'            => 1,
                'title'                 => 'Khoa học tự nhiên',
                'level'                 => 1,
                'sequence'              => 1,
            ],
            [
                'subject_id'            => 2,
                'title'                 => 'Khoa học xã hội',
                'level'                 => 1,
                'sequence'              => 2,
            ],
            [
                'subject_id'            => 3,
                'title'                 => 'Kỹ thuật',
                'level'                 => 1,
                'sequence'              => 3,
            ],
            [
                'subject_id'            => 4,
                'title'                 => 'Văn hóa',
                'level'                 => 1,
                'sequence'              => 4,
            ],

            // level 2
            [
                'subject_id'            => 5,
                'title'                 => 'Địa chất học',
                'level'                 => 2,
                'sequence'              => 1,
            ],
            [
                'subject_id'            => 6,
                'title'                 => 'Địa lý học',
                'level'                 => 2,
                'sequence'              => 2,
            ],
            [
                'subject_id'            => 7,
                'title'                 => 'Hóa học',
                'level'                 => 2,
                'sequence'              => 3,
            ],
            [
                'subject_id'            => 8,
                'title'                 => 'Khoa học máy tính',
                'level'                 => 2,
                'sequence'              => 4,
            ],
            [
                'subject_id'            => 9,
                'title'                 => 'Logic',
                'level'                 => 2,
                'sequence'              => 5,
            ],
            [
                'subject_id'            => 10,
                'title'                 => 'Sinh học',
                'level'                 => 2,
                'sequence'              => 6,
            ],
            [
                'subject_id'            => 11,
                'title'                 => 'Thiên văn học',
                'level'                 => 2,
                'sequence'              => 7,
            ],
            [
                'subject_id'            => 12,
                'title'                 => 'Toán học',
                'level'                 => 2,
                'sequence'              => 8,
            ],
            [
                'subject_id'            => 13,
                'title'                 => 'Vật lý học',
                'level'                 => 2,
                'sequence'              => 9,
            ],
            [
                'subject_id'            => 14,
                'title'                 => 'Y học',
                'level'                 => 2,
                'sequence'              => 10,
            ],


            [
                'subject_id'            => 15,
                'title'                 => 'Chính trị học',
                'level'                 => 2,
                'sequence'              => 1,
            ],
            [
                'subject_id'            => 16,
                'title'                 => 'Giáo dục',
                'level'                 => 2,
                'sequence'              => 2,
            ],
            [
                'subject_id'            => 17,
                'title'                 => 'Kinh tế học',
                'level'                 => 2,
                'sequence'              => 3,
            ],
            [
                'subject_id'            => 18,
                'title'                 => 'Lịch sử',
                'level'                 => 2,
                'sequence'              => 4,
            ],
            [
                'subject_id'            => 19,
                'title'                 => 'Luật pháp',
                'level'                 => 2,
                'sequence'              => 5,
            ],
            [
                'subject_id'            => 20,
                'title'                 => 'Ngôn ngữ học',
                'level'                 => 2,
                'sequence'              => 6,
            ],
            [
                'subject_id'            => 21,
                'title'                 => 'Nhân chủng học',
                'level'                 => 2,
                'sequence'              => 7,
            ],
            [
                'subject_id'            => 22,
                'title'                 => 'Tâm lý học',
                'level'                 => 2,
                'sequence'              => 8,
            ],
            [
                'subject_id'            => 23,
                'title'                 => 'Thần học',
                'level'                 => 2,
                'sequence'              => 9,
            ],
            [
                'subject_id'            => 24,
                'title'                 => 'Triết học',
                'level'                 => 2,
                'sequence'              => 10,
            ],
            [
                'subject_id'            => 25,
                'title'                 => ' Xã hội học',
                'level'                 => 2,
                'sequence'              => 11,
            ],


            [
                'subject_id'            => 26,
                'title'                 => 'Công nghiệp',
                'level'                 => 2,
                'sequence'              => 1,
            ],
            [
                'subject_id'            => 27,
                'title'                 => 'Cơ học',
                'level'                 => 2,
                'sequence'              => 2,
            ],
            [
                'subject_id'            => 28,
                'title'                 => 'Điện tử học',
                'level'                 => 2,
                'sequence'              => 3,
            ],
            [
                'subject_id'            => 29,
                'title'                 => 'Giao thông',
                'level'                 => 2,
                'sequence'              => 4,
            ],
            [
                'subject_id'            => 30,
                'title'                 => 'Kiến trúc',
                'level'                 => 2,
                'sequence'              => 5,
            ],
            [
                'subject_id'            => 31,
                'title'                 => 'Năng lượng',
                'level'                 => 2,
                'sequence'              => 6,
            ],
            [
                'subject_id'            => 32,
                'title'                 => 'Người máy',
                'level'                 => 2,
                'sequence'              => 7,
            ],
            [
                'subject_id'            => 33,
                'title'                 => 'Nông nghiệp',
                'level'                 => 2,
                'sequence'              => 8,
            ],
            [
                'subject_id'            => 34,
                'title'                 => 'Quân sự',
                'level'                 => 2,
                'sequence'              => 9,
            ],
            [
                'subject_id'            => 35,
                'title'                 => 'Y tế',
                'level'                 => 2,
                'sequence'              => 10,
            ],


            [
                'subject_id'            => 36,
                'title'                 => 'Âm nhạc',
                'level'                 => 2,
                'sequence'              => 1,
            ],
            [
                'subject_id'            => 37,
                'title'                 => 'Chính trị',
                'level'                 => 2,
                'sequence'              => 2,
            ],
            [
                'subject_id'            => 38,
                'title'                 => 'Du lịch',
                'level'                 => 2,
                'sequence'              => 3,
            ],
            [
                'subject_id'            => 39,
                'title'                 => 'Điện ảnh',
                'level'                 => 2,
                'sequence'              => 4,
            ],
            [
                'subject_id'            => 40,
                'title'                 => 'Giải trí',
                'level'                 => 2,
                'sequence'              => 5,
            ],
            [
                'subject_id'            => 41,
                'title'                 => 'Vũ đạo',
                'level'                 => 2,
                'sequence'              => 6,
            ],
            [
                'subject_id'            => 42,
                'title'                 => 'Nghệ thuật',
                'level'                 => 2,
                'sequence'              => 7,
            ],
            [
                'subject_id'            => 43,
                'title'                 => 'Phong tục tập quán',
                'level'                 => 2,
                'sequence'              => 8,
            ],
            [
                'subject_id'            => 44,
                'title'                 => 'Thần thoại',
                'level'                 => 2,
                'sequence'              => 9,
            ],
            [
                'subject_id'            => 45,
                'title'                 => 'Thể thao',
                'level'                 => 2,
                'sequence'              => 10,
            ],
            [
                'subject_id'            => 46,
                'title'                 => 'Thời trang',
                'level'                 => 2,
                'sequence'              => 11,
            ],
            [
                'subject_id'            => 47,
                'title'                 => 'Tôn giáo',
                'level'                 => 2,
                'sequence'              => 12,
            ],
            [
                'subject_id'            => 48,
                'title'                 => 'Văn học',
                'level'                 => 2,
                'sequence'              => 13,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders\KnowledgeArticle;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('kam__knowledge_articles')->insert([

            [
                'knowledge_article_id'  => 1,
                'title'                 => 'Giải thưởng vật lý',
            ],
             [
                 'knowledge_article_id'  => 2,
                 'title'                 => 'Hiện tượng vật lý',
             ],
             [
                 'knowledge_article_id'  => 3,
                 'title'                 => 'Hiệu ứng vật lý',
             ],
             [
                 'knowledge_article_id'  => 4,
                 'title'                 => 'Cơ học cổ điển',
             ],
             [
                 'knowledge_article_id'  => 5,
                 'title'                 => 'Quang học',
             ],
             [
                 'knowledge_article_id'  => 6,
                 'title'                 => 'Vật lý học ứng dụng',
             ],
             [
                 'knowledge_article_id'  => 7,
                 'title'                 => 'Nhiệt động lực học‎',
             ],
             [
                 'knowledge_article_id'  => 8,
                 'title'                 => 'Động lực học',
             ],
             [
                 'knowledge_article_id'  => 9,
                 'title'                 => 'Lực hấp dẫn',
             ],
             [
                 'knowledge_article_id'  => 10,
                 'title'                 => 'Trạng thái vật chất',
             ],
         ]);
    }
}

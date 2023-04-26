<?php

namespace Database\Seeders\KnowledgeArticle;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectKnowledgeArticleAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kam__subject_knowledge_article_allocations')->insert([

            [
                'subject_knowledge_article_allocation_id'  => 1,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 1
            ],
            [
                'subject_knowledge_article_allocation_id'  => 2,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 2
            ],
            [
                'subject_knowledge_article_allocation_id'  => 3,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 3
            ],
            [
                'subject_knowledge_article_allocation_id'  => 4,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 4
            ],
            [
                'subject_knowledge_article_allocation_id'  => 5,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 5
            ],
            [
                'subject_knowledge_article_allocation_id'  => 6,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 6
            ],
            [
                'subject_knowledge_article_allocation_id'  => 7,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 7
            ],
            [
                'subject_knowledge_article_allocation_id'  => 8,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 8
            ],
            [
                'subject_knowledge_article_allocation_id'  => 9,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 9
            ],
            [
                'subject_knowledge_article_allocation_id'  => 10,
                'subject_id'                                => 1,
                'knowledge_article_id'                      => 10
            ],
        ]);
    }
}

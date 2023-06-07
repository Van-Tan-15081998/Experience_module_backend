<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class KnowledgeArticleContentUnitEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'knowledge_article_content_unit_id',
        'title',
        'content',
        'sequence',

        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];

    protected $table = 'kam__knowledge_article_content_units';
    protected $primaryKey = 'knowledge_article_content_unit_id';

    public function getById(int $subjectId): AdminKnowledgeArticleContentUnitModel
    {
        $detail = null;

        try {
            $detail = $this->selectById($subjectId);


        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectById(int $knowledgeArticleId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.knowledge_article_id = " . $knowledgeArticleId
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticle =  AdminKnowledgeArticleContentUnitModel::createFromRecord($result[0]);

        return $adminKnowledgeArticle;
    }

    public function getEditKnowledgeArticleById(int $knowledgeArticleId): AdminKnowledgeArticleContentUnitModel
    {
        $detail = null;

        try {
            $detail = $this->selectEditKnowledgeArticleById($knowledgeArticleId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectEditKnowledgeArticleContentUnitByKnowledgeArticleId(int $knowledgeArticleId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.knowledge_article_id = " . $knowledgeArticleId
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticle =  AdminKnowledgeArticleContentUnitModel::createFromRecordForEdit($result[0]);

        return $adminKnowledgeArticle;
    }

    public function insertKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitUpdateParam $param): int
    {
        $knowledgeArticleId = DB::table('kam__knowledge_articles')->insertGetId(
            [
                'title'     => $param->getTitle(),
            ]
        );

        if($knowledgeArticleId) {
            DB::table('kam__subject_knowledge_article_allocations')->insert(
                [
                    'knowledge_article_id'  => $knowledgeArticleId,
                    'subject_id'            => $param->getSubjectId()
                ]
            );
        }

        return $knowledgeArticleId;
    }

    public function updateKnowledgeArticle(AdminKnowledgeArticleContentUnitUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__knowledge_articles')
            ->where('knowledge_article_id', '=', $param->getKnowledgeArticleId())
            ->update([
                'title'     => $param->getTitle(),
            ]);

        return $param->getKnowledgeArticleId();
    }
}

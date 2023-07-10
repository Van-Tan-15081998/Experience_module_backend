<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitNewParam;
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

    public function selectById(int $knowledgeArticleContentUnitId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_article_content_units"
            . " WHERE kam__knowledge_article_content_units.knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_content_units.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticleContentUnit =  AdminKnowledgeArticleContentUnitModel::createFromRecord($result[0]);

        return $adminKnowledgeArticleContentUnit;
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

    public function getEditKnowledgeArticleContentUnitById($knowledgeArticleContentUnitId)
    {
        $detail = null;

        try {
            $detail = $this->selectEditKnowledgeArticleContentUnitById($knowledgeArticleContentUnitId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectEditKnowledgeArticleContentUnitById(int $knowledgeArticleContentUnitId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_article_content_units"
            . " WHERE kam__knowledge_article_content_units.knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_content_units.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticleContentUnit =  AdminKnowledgeArticleContentUnitModel::createFromRecordForEdit($result[0]);

        return $adminKnowledgeArticleContentUnit;
    }

    public function insertKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitNewParam $param): int
    {
        $knowledgeArticleContentUnitId = DB::table('kam__knowledge_article_content_units')->insertGetId(
            [
                'title'     => $param->getTitle(),
                'unit_content'   => $param->getUnitContent()
            ]
        );

        if($knowledgeArticleContentUnitId) {
            DB::table('kam__ka_ka_content_unit_allocations')->insert(
                [
                    'knowledge_article_id'  => $param->getKnowledgeArticleId(),
                    'knowledge_article_content_unit_id' => $knowledgeArticleContentUnitId,
                ]
            );
        }

        return $knowledgeArticleContentUnitId;
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

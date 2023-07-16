<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleCondition;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticlePaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleUpdateParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\KnowledgeArticleImageContentUnit\KnowledgeArticleImageContentUnitModel;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KnowledgeArticleEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'knowledge_article_id',
        'title',

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

    protected $table = 'kam__knowledge_articles';
    protected $primaryKey = 'knowledge_article_id';

    public function getPage(PageInfo $pageInfo, AdminKnowledgeArticleCondition $condition): ?AdminKnowledgeArticlePaginationModel
    {
        $page = null;

        try {
            $page = $this->paginateByCondition($pageInfo, $condition);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $page;
    }

    public function paginateByCondition(PageInfo $pageInfo, AdminKnowledgeArticleCondition $condition = null): AdminKnowledgeArticlePaginationModel
    {
        $result = [];


        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.is_deleted = 0";

        if (!is_null($condition)) {
            $query .= '';
            // TODO
        }

        return $this->paginate($query, $pageInfo, new AdminKnowledgeArticlePaginationModel());
    }

    protected function paginate(string $query,
                                PageInfo $pageInfo,
                                PaginationModel $paginationModelClass,
                                string $paginateFunctionName = null
    ): PaginationModel
    {
        $start = $pageInfo->getStartPage();

        if ($start < 1) {
            $start = 1;
        }

        $limit = $pageInfo->getLimitCount();

        $originalQuery = $query;

        $query .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

        $data = DB::select($query);

        $cnt = 0;

        if(count($data) > 0) {

            $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
            $countResultExecute = DB::select($countResultQuery);

            $cnt = $countResultExecute[0]->paginate_total_count;
        } else {
            if($start > 1) {

                $start = 1;

                $originalQuery .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

                $data = DB::select($originalQuery);

                if(count($data) > 0) {
                    $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
                    $countResultExecute = DB::select($countResultQuery);

                    $cnt = $countResultExecute[0]->paginate_total_count;
                }
            }
        }

        $lastPage = (int) ceil($cnt / $limit);

        $paginationInfo = new PaginationInfo();
        $paginationInfo->setCurrentPage($start);
        $paginationInfo->setTotalPages($lastPage);
        $paginationInfo->setLimitCount($limit);
        $paginationInfo->setTotalCount($cnt);

        $modelClass = get_Class($paginationModelClass);
        $return = new $modelClass();
        $return->setPaginationInfo($paginationInfo);

        if(!isset($paginateFunctionName)) {
            $paginateFunctionName = 'convertResult';
        }

        $return->$paginateFunctionName($data);

        return $return;
    }

    public function getById(int $subjectId): AdminKnowledgeArticleModel
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

    public function selectById(int $knowledgeArticleId): ?AdminKnowledgeArticleModel
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

        $adminKnowledgeArticle =  AdminKnowledgeArticleModel::createFromRecord($result[0]);

        // Lấy danh sách Unit Content
        $getUnitContentQuery =
            "SELECT *"
            .   " FROM kam__knowledge_article_content_units"
            .   " JOIN kam__ka_ka_content_unit_allocations"
            .       " ON kam__knowledge_article_content_units.knowledge_article_content_unit_id = kam__ka_ka_content_unit_allocations.knowledge_article_content_unit_id"
            .       " AND kam__ka_ka_content_unit_allocations.knowledge_article_id = " . $knowledgeArticleId
            .   " WHERE kam__knowledge_article_content_units.is_deleted = 0"
            .   " AND kam__ka_ka_content_unit_allocations.is_deleted = 0";

        $unitContentList = DB::select($getUnitContentQuery);

        $unitContentListResult = new DreamerTypeList([]);

        foreach($unitContentList as $unitContent) {
            $item = AdminKnowledgeArticleContentUnitModel::createFromRecord($unitContent);
            $item->setImageList($this->selectKnowledgeArticleImageContentUnitByKnowledgeArticleContentUnitId($item->getKnowledgeArticleContentUnitId()));

            $unitContentListResult->add($item);
        }

        $adminKnowledgeArticle->setUnitContentList($unitContentListResult);

        return $adminKnowledgeArticle;
    }

    public function selectKnowledgeArticleImageContentUnitByKnowledgeArticleContentUnitId(int $knowledgeArticleContentUnitId) : DreamerTypeList
    {
        $result = new DreamerTypeList();

        // Get images
        $queryGetImages =
            "SELECT *"
            . " FROM kam__knowledge_article_image_content_units"
            . " WHERE knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_image_content_units.is_deleted = 0 ";

        $imageQueryResult = DB::select($queryGetImages);

        if (is_null($imageQueryResult) || empty($imageQueryResult)) {
            return new DreamerTypeList();
        }

        foreach ($imageQueryResult as $image) {
            $result->add(KnowledgeArticleImageContentUnitModel::createFromRecord($image));
        }

        return $result;
    }

    public function getEditKnowledgeArticleById(int $knowledgeArticleId): AdminKnowledgeArticleModel
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

    public function selectEditKnowledgeArticleById(int $knowledgeArticleId): ?AdminKnowledgeArticleModel
    {
//        $query =
//            "SELECT *"
//            . " FROM kam__knowledge_articles"
//            . " WHERE kam__knowledge_articles.knowledge_article_id = " . $knowledgeArticleId
//            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.knowledge_article_id = " . $knowledgeArticleId
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticle =  AdminKnowledgeArticleModel::createFromRecordForEdit($result[0]);

        return $adminKnowledgeArticle;
    }

    public function insertKnowledgeArticle(AdminKnowledgeArticleUpdateParam $param): int
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

    public function updateKnowledgeArticle(AdminKnowledgeArticleUpdateParam $param): int
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

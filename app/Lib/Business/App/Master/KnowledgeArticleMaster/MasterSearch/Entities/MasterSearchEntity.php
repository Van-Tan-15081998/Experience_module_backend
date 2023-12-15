<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchCondition;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagModel;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterSearchEntity extends Model
{
    public function search(AdminMasterSearchCondition $condition) {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.title LIKE '%" . $condition->getSearchString() . "%'"
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList();
        }

        $knowledgeArticleList = new DreamerTypeList();
        foreach ($result as $item) {
            $knowledgeArticleList->add(AdminKnowledgeArticleModel::createFromRecord($item));
        }

        $adminMasterSearchResult =  AdminMasterSearchModel::createFromRecord();

        $adminMasterSearchResult->setKnowledgeArticleList($knowledgeArticleList);

        return $adminMasterSearchResult->toArray();
    }

    public function getPage(PageInfo $pageInfo, AdminMasterSearchCondition $condition): ?AdminMasterSearchPaginationModel
    {
        $page = null;

        try {
            $page = $this->paginateByCondition($pageInfo, $condition);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $page;
    }

    public function paginateByCondition(PageInfo $pageInfo, AdminMasterSearchCondition $condition = null): AdminMasterSearchPaginationModel
    {
        $result = [];

        /**
         * //
         **/
        $query = "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.title LIKE '%" . $condition->getSearchString() . "%'"
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        if (!is_null($condition)) {
            $query .= '';
            // TODO
        }

        return $this->paginate($query, $pageInfo, new AdminMasterSearchPaginationModel());
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

    public function getTagList(): DreamerTypeList
    {
        return $this->selectTagList();
    }

    public function selectTagList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__tags"
            . " WHERE kam__tags.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $tagList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $tag = AdminTagModel::createFromRecord($record);
            $tagList->add($tag);
        }

        return $tagList;
    }
}

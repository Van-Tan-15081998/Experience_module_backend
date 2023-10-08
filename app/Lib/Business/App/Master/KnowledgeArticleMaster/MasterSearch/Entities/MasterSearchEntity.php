<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchCondition;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchModel;
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
}

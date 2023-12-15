<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Common\Core\DataSource\Models\PaginationModel;

class AdminMasterSearchPaginationModel extends PaginationModel
{
    public function convertResult(array $result): void
    {
        $convertArray = [];

        foreach ($result as $row) {
            // Hiện tại chỉ truy xuất Knowledge article nên convert theo Knowledge article

//            $convertArray[] = AdminMasterSearchModel::createFromRecord($row);
            $convertArray[] = AdminKnowledgeArticleModel::createFromRecord($row);
        }

        $this->setList($convertArray);
    }
}

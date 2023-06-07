<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models;

use App\Lib\Common\Core\DataSource\Models\PaginationModel;

class AdminKnowledgeArticlePaginationModel extends PaginationModel
{
    public function convertResult(array $result): void
    {
        $convertArray = [];

        foreach ($result as $row) {
            $convertArray[] = AdminKnowledgeArticleListModel::createFromRecord($row);
        }

        $this->setList($convertArray);
    }
}

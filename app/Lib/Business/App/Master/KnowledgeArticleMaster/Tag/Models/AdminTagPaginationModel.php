<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models;

use App\Lib\Common\Core\DataSource\Models\PaginationModel;

class AdminTagPaginationModel extends PaginationModel
{
    public function convertResult(array $result): void
    {
        $convertArray = [];

        foreach ($result as $row) {
            $convertArray[] = AdminTagListModel::createFromRecord($row);
        }

        $this->setList($convertArray);
    }
}

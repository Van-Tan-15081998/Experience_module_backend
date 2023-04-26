<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models;

use App\Lib\Common\Core\DataSource\Models\PaginationModel;

class AdminSubjectPaginationModel extends PaginationModel
{
    public function convertResult(array $result): void
    {
        $convertArray = [];

        foreach ($result as $row) {
            $convertArray[] = AdminSubjectListModel::createFromRecord($row);
        }

        $this->setList($convertArray);
    }
}

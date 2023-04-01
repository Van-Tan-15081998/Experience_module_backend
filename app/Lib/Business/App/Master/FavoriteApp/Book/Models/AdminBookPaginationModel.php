<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book\Models;

use App\Lib\Common\Core\DataSource\Models\PaginationModel;

class AdminBookPaginationModel extends PaginationModel
{
    public function convertResult(array $result): void
    {
        $convertArray = [];

        foreach ($result as $row) {
            $convertArray[] = BookModel::createFromRecord($row);
        }

        $this->setList($convertArray);
    }
}

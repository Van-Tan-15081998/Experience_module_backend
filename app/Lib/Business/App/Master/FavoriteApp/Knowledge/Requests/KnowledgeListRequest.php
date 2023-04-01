<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Knowledge\Requests;
const PAGINATION_DEFAULT_LIMIT_COUNT = 10;

class KnowledgeListRequest
{
    public function getPageNo(): int
    {
        if ($this->has('pageNo')) {
            return (int)$this->pageNo;
        } else {
            return 1;
        }
    }

    public function getLimitCount(): int
    {
        if ($this->has('limitCount')) {
            return (int)$this->limitCount;
        } else {
            return PAGINATION_DEFAULT_LIMIT_COUNT;
        }
    }

    public function getSearchCondition() {

    }
}

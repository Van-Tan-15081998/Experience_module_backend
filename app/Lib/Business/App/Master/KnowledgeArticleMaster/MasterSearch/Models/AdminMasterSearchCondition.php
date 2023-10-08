<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models;

class AdminMasterSearchCondition
{
    private String $searchString = '';

    /**
     * @return String
     */
    public function getSearchString(): string
    {
        return $this->searchString;
    }

    /**
     * @param String $searchString
     */
    public function setSearchString(string $searchString): void
    {
        $this->searchString = $searchString;
    }


}

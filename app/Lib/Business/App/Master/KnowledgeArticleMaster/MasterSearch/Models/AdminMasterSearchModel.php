<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models;

use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;

class AdminMasterSearchModel extends DreamerTypeObject
{
    private DreamerTypeList $subjectList;
    private DreamerTypeList $knowledgeArticleList;

    /**
     * @return DreamerTypeList
     */
    public function getSubjectList(): DreamerTypeList
    {
        return $this->subjectList;
    }

    /**
     * @param DreamerTypeList $subjectList
     */
    public function setSubjectList(DreamerTypeList $subjectList): void
    {
        $this->subjectList = $subjectList;
    }

    /**
     * @return DreamerTypeList
     */
    public function getKnowledgeArticleList(): DreamerTypeList
    {
        return $this->knowledgeArticleList;
    }

    /**
     * @param DreamerTypeList $knowledgeArticleList
     */
    public function setKnowledgeArticleList(DreamerTypeList $knowledgeArticleList): void
    {
        $this->knowledgeArticleList = $knowledgeArticleList;
    }

    public static function createFromRecord(): AdminMasterSearchModel
    {
        return new AdminMasterSearchModel();
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

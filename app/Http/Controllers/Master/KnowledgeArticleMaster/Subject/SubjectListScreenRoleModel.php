<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Subject;

use App\Http\Controllers\Base\KnowledgeArticleMaster\Subject\Model\SubjectScreenRoleModel;

class SubjectListScreenRoleModel extends SubjectScreenRoleModel
{
    private bool $isBrowseForDetail;

    /**
     * @return bool
     */
    public function isBrowseForDetail(): bool
    {
        return $this->isBrowseForDetail;
    }

    /**
     * @param bool $isBrowseForDetail
     */
    public function setIsBrowseForDetail(bool $isBrowseForDetail): void
    {
        $this->isBrowseForDetail = $isBrowseForDetail;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $myTarget = parent::toArrayFromModel($target);

        $parentTarget = parent::toArray();

        return array_merge($parentTarget, $myTarget);
    }
}

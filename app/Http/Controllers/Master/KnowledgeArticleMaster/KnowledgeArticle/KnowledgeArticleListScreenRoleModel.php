<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle;

use App\Http\Controllers\Base\KnowledgeArticleMaster\KnowledgeArticle\Model\KnowledgeArticleScreenRoleModel;

class KnowledgeArticleListScreenRoleModel extends KnowledgeArticleScreenRoleModel
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

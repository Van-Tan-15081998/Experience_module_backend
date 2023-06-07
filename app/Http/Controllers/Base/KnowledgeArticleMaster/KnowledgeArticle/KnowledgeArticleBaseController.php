<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\KnowledgeArticle;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\KnowledgeArticleMaster\KnowledgeArticle\Model\KnowledgeArticleScreenRoleModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;

abstract class KnowledgeArticleBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getKnowledgeArticleRole(AdminPageType $pageType, array $screenOptional=null): KnowledgeArticleScreenRoleModel
    {
        return KnowledgeArticleScreenRoleModel::cast(parent::getRole($pageType, $screenOptional));
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new KnowledgeArticleScreenRoleModel();
    }
}

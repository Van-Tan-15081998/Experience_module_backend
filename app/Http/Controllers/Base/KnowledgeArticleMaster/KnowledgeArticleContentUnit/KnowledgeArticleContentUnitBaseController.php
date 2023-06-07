<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Model\KnowledgeArticleContentUnitScreenRoleModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;

abstract class KnowledgeArticleContentUnitBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getKnowledgeArticleContentUnitRole(AdminPageType $pageType, array $screenOptional=null): KnowledgeArticleContentUnitScreenRoleModel
    {
        return KnowledgeArticleContentUnitScreenRoleModel::cast(parent::getRole($pageType, $screenOptional));
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new KnowledgeArticleContentUnitScreenRoleModel();
    }
}

<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\Tag;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Tag\Model\TagScreenRoleModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;

abstract class TagBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getTagRole(AdminPageType $pageType, array $screenOptional=null): TagScreenRoleModel
    {
        return TagScreenRoleModel::cast(parent::getRole($pageType, $screenOptional));
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new TagScreenRoleModel();
    }
}

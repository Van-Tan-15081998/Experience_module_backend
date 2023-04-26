<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\Subject;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Subject\Model\SubjectScreenRoleModel;

abstract class SubjectBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getSubjectRole(AdminPageType $pageType, array $screenOptional=null): SubjectScreenRoleModel
    {
        return SubjectScreenRoleModel::cast(parent::getRole($pageType, $screenOptional));
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new SubjectScreenRoleModel();
    }
}

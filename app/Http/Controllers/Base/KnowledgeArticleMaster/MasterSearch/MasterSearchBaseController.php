<?php

namespace App\Http\Controllers\Base\KnowledgeArticleMaster\MasterSearch;

use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;

class MasterSearchBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel
    {
        // TODO: Implement createScreenRole() method.
        return null;
    }
}

<?php

namespace App\Lib\Business\App\Admin\Common;

use App\Lib\Business\App\Admin\Common\Entities\RoleEntity;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use Illuminate\Support\Facades\App;

class AdminRoleBusiness extends ExperienceBaseBusiness
{
    private RoleEntity $roleEntity;

    public function __construct()
    {
        parent::__construct();
//        $this->roleEntity = new RoleEntity();
        $this->roleEntity = App::make(RoleEntity::class);
    }

    public function getRoles(int $accountId, int $screenId, array $relatedScreenIds=null): RoleFunctionListModel
    {
        $screenIds[] = $screenId;
        if($relatedScreenIds !== null) {
            $screenIds = array_merge($screenIds, $relatedScreenIds);
        }

        $roleList = $this->getRoleList($accountId, $screenIds);

        return $roleList;
    }

    public function getRoleList(int $accountId, array $screenIds): ?RoleFunctionListModel
    {
        $roleList = null;

        try {
            // TODO
            $roles = $this->roleEntity->selectRoleByAccountId($accountId, $screenIds);

            if($roles !== null) {
                $roleList = $this->convertRole($roles);


            }
        } catch(\Exception $e) {
            // TODO
        }

        return $roleList;
    }

    public function getFunctionByScreenId(int $screenId): ?RoleFunctionModel
    {
        $function = null;

        try {
            // TODO
        } catch(\Exception $e) {
            // TODO
        }

        return $function;
    }

    private function convertRole(array $roles): RoleFunctionListModel
    {
        $roleList = new RoleFunctionListModel();

        foreach($roles as $role) {

            $foundRole = $roleList->getByScreenId($role->getScreenId());
            if($foundRole === null) {
                $roleList->add($role);
            } else {
                $foundRole->merge($role);
            }
        }

        return $roleList;
    }

    private function mergeToRole(RoleFunctionListModel $roleList, array $componentRoles): void
    {
        // TODO
    }
}

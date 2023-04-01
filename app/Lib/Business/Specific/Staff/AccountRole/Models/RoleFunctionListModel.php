<?php

namespace App\Lib\Business\Specific\Staff\AccountRole\Models;

class RoleFunctionListModel
{
    private array $functionRoleList;

    public function __construct()
    {
        $this->functionRoleList = array();
    }

    public function getList(): array
    {
        return $this->functionRoleList;
    }

    public function setList(array $roleList): void
    {
        $this->functionRoleList = $roleList;
    }

    public function add(RoleFunctionModel $role): void
    {
        $this->functionRoleList[] = $role;
    }

    public function getByScreenId(int $screenId): ?RoleFunctionModel
    {
        $list = $this->functionRoleList;

        foreach ($list as $role) {

            if ($role->getScreenId() === $screenId) {
                return $role;
            }
        }

        return null;
    }

    public function getByFunctionId(int $screenId): ?RoleFunctionModel
    {
        $list = $this->functionRoleList;

        foreach ($list as $role) {

            if ($role->getFunctionId() === $screenId) {
                return $role;
            }
        }

        return null;
    }

    public function toArray(): array
    {
//        $target = get_object_vars($this);
//        return json_decode(json_encode($target), true);
        return $this->functionRoleList;
    }
}

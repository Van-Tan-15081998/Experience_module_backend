<?php

namespace App\Lib\Business\App\Admin\Common;

use App\Lib\Business\App\Admin\Common\Models\MenuGroupModel;
use App\Lib\Common\Type\DreamerTypeList;

class AdminMenuBusiness
{
    public function __construct()
    {

    }

    public function getMenu(int $accountId): DreamerTypeList
    {
        return $this->createMenu($accountId);
    }

    public function getMenuByScreenId(int $screenId): array
    {
        $menuGroups = array();

        try {

        } catch(\Exception $e) {

        }

        return $menuGroups;
    }

    private function createMenu(int $accountId): DreamerTypeList
    {
        $menuGroups = new DreamerTypeList([]);

        try {
            // TODO
        } catch(Exception $e) {
            // TODO
        }

        return $menuGroups;
    }

    private function convertMenu(array $adminMenus): array
    {
        $menuGroups = array();

        return $menuGroups;
    }

    private function findMenuGroup(array $menuGroups, int $findId): ?MenuGroupModel
    {
        foreach($menuGroups as $menuGroup) {

            if($menuGroup->getMenuGroupId() === $findId) {
                return $menuGroup;
            }
        }

        return null;
    }
}

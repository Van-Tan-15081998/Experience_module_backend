<?php

namespace App\Lib\Business\App\Admin\Common;

use App\Lib\Business\App\Admin\Common\Models\AdminCommonDisplayModel;
use App\Lib\Business\App\Admin\Common\Models\MenuGroupModel;
use App\Lib\Business\App\Admin\Common\Models\ScreenModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;

class AdminCommonBusiness
{
    private AdminMenuBusiness $adminMenuBusiness;
    private AdminRoleBusiness $adminRoleBusiness;

    public function __construct()
    {
        $this->adminMenuBusiness = App::make(AdminMenuBusiness::class);
        $this->adminRoleBusiness = App::make(AdminRoleBusiness::class);
    }

    public function getCommonDisplayInfo(int $accountId,
                                         int $screenId,
                                         int $breadcrumbPageId,
                                         array $relatedScreenIds = null): AdminCommonDisplayModel
    {
        $displayInfo = new AdminCommonDisplayModel();

        $menuGroupList = $this->adminMenuBusiness->getMenu($accountId);
        $displayInfo->setMenuGroupList($menuGroupList);

        $screenIds[] = $screenId;
        $screenIds[] = $breadcrumbPageId;

        if($relatedScreenIds !== null) {
            $screenIds = array_merge($screenIds, $relatedScreenIds);
        }

        $roleList = $this->adminRoleBusiness->getRoleList($accountId, $screenIds);
        $displayInfo->setRelatedScreenRoleList($roleList);

        $screenInfo = $this->getScreenInfo($screenId, $breadcrumbPageId, $roleList, $menuGroupList);
        $displayInfo->setScreenInfo($screenInfo);

        return $displayInfo;
    }

    public function getDialogCommonDisplayInfo( int $accountId,
                                                int $screenId,
                                                array $relatedScreenIds=null): AdminCommonDisplayModel
    {
        $displayInfo = new AdminCommonDisplayModel();

        return $displayInfo;
    }

    public function getRoles(int $accountId, int $screenId, array $relatedScreenIds = null): RoleFunctionListModel
    {
        return $this->adminRoleBusiness->getRoles($accountId, $screenId, $relatedScreenIds);
    }

    private function getScreenInfo( int $screenId,
                                    ?int $breadcrumbPageId,
                                    RoleFunctionListModel $roleList,
                                    ?DreamerTypeList $menuGroupList): ScreenModel
    {
        $functionRole = $roleList->getByScreenId($screenId);

        $screen = new ScreenModel();

        if(is_null($functionRole)) {
            if(isset($breadcrumbPageId)) {
                $menuGroupList = $this->adminMenuBusiness->getMenuByScreenId($breadcrumbPageId);
            }

            $functionRole = $this->adminRoleBusiness->getFunctionByScreenId($screenId);
            if($functionRole !== null) {
                $functionRole->setIsBrowse(false);
                $functionRole->setIsRegistration(false);
                $functionRole->setIsEdit(false);
                $functionRole->setIsDelete(false);
                $functionRole->setIsUpload(false);
                $functionRole->setIsDownload(false);
            }
        }

        if($functionRole !== null) {
            $screen->setScreenId($functionRole->getScreenId());
            $screen->setFunctionTitle($functionRole->getFunctionName());
            $screen->setScreenTitle($functionRole->getScreenName());
            $screen->setRole($functionRole);
        } else {

            $screen->setFunctionTitle('');
            $screen->setScreenTitle('');
            $screen->setRole(null);
        }

        $screen->setMenuGroup(null);
        if(isset($menuGroupList)) {
            $menu = $this->findMenuGroup($menuGroupList, $breadcrumbPageId);
            if(isset($menu)) {
                $screen->setMenuGroup($menu);
            }
        }

        return $screen;
    }

    private function findMenuGroup(DreamerTypeList $menuGroupList, int $screenId): ?MenuGroupModel
    {
        $list = $menuGroupList;

        foreach ($list as $group) {
            if (!is_null($group->getCategoryByScreenId($screenId))) {
                return $group;
            }
        }

        return null;
    }
}

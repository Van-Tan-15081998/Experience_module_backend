<?php

namespace App\Lib\Business\App\Admin\Common\Models;

use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;

class AdminCommonDisplayModel extends DreamerTypeObject
{
    private DreamerTypeList $menuGroupList;
    private ScreenModel $screenInfo;
    private RoleFunctionListModel $relatedScreenRoleList;

    public function __construct()
    {
        parent::__construct();
        $this->relatedScreenRoleList = new RoleFunctionListModel();
    }

    /**
     * @return DreamerTypeList
     */
    public function getMenuGroupList(): DreamerTypeList
    {
        return $this->menuGroupList;
    }

    /**
     * @param DreamerTypeList $menuGroupList
     */
    public function setMenuGroupList(DreamerTypeList $menuGroupList): void
    {
        $this->menuGroupList = $menuGroupList;
    }

    /**
     * @return ScreenModel
     */
    public function getScreenInfo(): ScreenModel
    {
        return $this->screenInfo;
    }

    /**
     * @param ScreenModel $screenInfo
     */
    public function setScreenInfo(ScreenModel $screenInfo): void
    {
        $this->screenInfo = $screenInfo;
    }

    /**
     * @return RoleFunctionListModel
     */
    public function getRelatedScreenRoleList(): RoleFunctionListModel
    {
        return $this->relatedScreenRoleList;
    }

    /**
     * @param RoleFunctionListModel $relatedScreenRoleList
     */
    public function setRelatedScreenRoleList(RoleFunctionListModel $relatedScreenRoleList): void
    {
        $this->relatedScreenRoleList = $relatedScreenRoleList;
    }

    public function toArray(): array
    {
        return [];
    }
}

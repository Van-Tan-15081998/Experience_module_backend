<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;

class ContentsModel extends DreamerTypeObject
{
    private string $pageTitle;
    private ScreenRoleModel $role;
    private DreamerTypeList $breadcrumbs;

    /**
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle(string $pageTitle): void
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return ScreenRoleModel
     */
    public function getRole(): ScreenRoleModel
    {
        return $this->role;
    }

    /**
     * @param ScreenRoleModel|null $role
     */
    public function setRole(?ScreenRoleModel $role): void
    {
        $this->role = $role;
    }

    /**
     * @return DreamerTypeList
     */
    public function getBreadcrumbs(): DreamerTypeList
    {
        return $this->breadcrumbs;
    }

    /**
     * @param DreamerTypeList $breadcrumbs
     */
    public function setBreadcrumbs(DreamerTypeList $breadcrumbs): void
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

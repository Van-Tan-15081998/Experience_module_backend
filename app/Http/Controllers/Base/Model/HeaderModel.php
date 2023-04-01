<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeObject;

class HeaderModel extends DreamerTypeObject
{
    private LogoModel $logo;
    private HeaderMenuModel $menu;

    /**
     * @return LogoModel
     */
    public function getLogo(): LogoModel
    {
        return $this->logo;
    }

    /**
     * @param LogoModel $logo
     */
    public function setLogo(LogoModel $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return HeaderMenuModel
     */
    public function getMenu(): HeaderMenuModel
    {
        return $this->menu;
    }

    /**
     * @param HeaderMenuModel $menu
     */
    public function setMenu(HeaderMenuModel $menu): void
    {
        $this->menu = $menu;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

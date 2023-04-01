<?php

namespace App\Lib\Business\App\Admin\Common\Models;

class MenuCategoryModel
{
    private int $menuCategoryId;
    private string $name;
    private int $sequence;

    private array $menuList;

    public function __construct()
    {
        $this->menuList = array();
    }

    /**
     * @return int
     */
    public function getMenuCategoryId(): int
    {
        return $this->menuCategoryId;
    }

    /**
     * @param int $menuCategoryId
     */
    public function setMenuCategoryId(int $menuCategoryId): void
    {
        $this->menuCategoryId = $menuCategoryId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     */
    public function setSequence(int $sequence): void
    {
        $this->sequence = $sequence;
    }

    /**
     * @return array
     */
    public function getMenuList(): array
    {
        return $this->menuList;
    }

    /**
     * @param array $menuList
     */
    public function setMenuList(array $menuList): void
    {
        $this->menuList = $menuList;
    }

    public function getMenuByMenuId(int $id): ?MenuModel
    {
        $list = $this->menuList;

        foreach ($list as $menu) {
            if($menu->getMenuId() === $id) {
                return $menu;
            }
        }

        return null;
    }

    public function getMenuByScreenId(int $screenId): ?MenuModel
    {
        $list = $this->menuList;

        foreach ($list as $menu) {
            if ($menu->getScreenId() === $screenId) {
                return $menu;
            }
        }
        return null;
    }

    public function addMenu(MenuModel $menu): MenuCategoryModel
    {
        $this->menuList[] = $menu;
        return $this;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

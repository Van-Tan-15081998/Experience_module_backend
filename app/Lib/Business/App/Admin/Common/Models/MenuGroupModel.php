<?php

namespace App\Lib\Business\App\Admin\Common\Models;

class MenuGroupModel
{
    private int $menuGroupId;
    private string $name;
    private int $sequence;

    private array $categoryList;

    public function __construct()
    {
        $this->categoryList = array();
    }

    /**
     * @return int
     */
    public function getMenuGroupId(): int
    {
        return $this->menuGroupId;
    }

    /**
     * @param int $menuGroupId
     */
    public function setMenuGroupId(int $menuGroupId): void
    {
        $this->menuGroupId = $menuGroupId;
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
    public function getCategoryList(): array
    {
        return $this->categoryList;
    }

    /**
     * @param array $categoryList
     */
    public function setCategoryList(array $categoryList): void
    {
        $this->categoryList = $categoryList;
    }

    public function getCategoryByCategoryId(int $id): ?MenuCategoryModel
    {
        $list = $this->categoryList;

        foreach ($list as $category) {
            if($category->getMenuCategoryId() === $id) {
                return $category;
            }
        }

        return null;
    }

    public function getCategoryByScreenId(int $screenId): ?MenuCategoryModel
    {
        $list = $this->categoryList;

        foreach ($list as $category) {
            if (!is_null($category->getMenuByScreenId($screenId))) {
                return $category;
            }
        }

        return null;
    }

    public function addCategory(MenuCategoryModel $category): MenuGroupModel
    {
        $this->categoryList[] = $category;
        return $this;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }

}

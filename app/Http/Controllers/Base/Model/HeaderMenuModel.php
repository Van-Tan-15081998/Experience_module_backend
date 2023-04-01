<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;

class HeaderMenuModel extends DreamerTypeObject
{
    private ?int $activeGroupId;
    private DreamerTypeList $groupList;

    public function __construct()
    {
        parent::__construct();

        $this->groupList = new DreamerTypeList([]);
    }

    /**
     * @return int|null
     */
    public function getActiveGroupId(): ?int
    {
        return $this->activeGroupId;
    }

    /**
     * @param int|null $activeGroupId
     */
    public function setActiveGroupId(?int $activeGroupId): void
    {
        $this->activeGroupId = $activeGroupId;
    }

    /**
     * @return DreamerTypeList
     */
    public function getGroupList(): DreamerTypeList
    {
        return $this->groupList;
    }

    /**
     * @param DreamerTypeList $groupList
     */
    public function setGroupList(DreamerTypeList $groupList): void
    {
        $this->groupList = $groupList;
    }

    public function setActiveGroupIdByScreenId(int $screenId): void
    {
        $this->activeGroupId = $this->getMenuGroupIdByScreenId($screenId);
    }

    private function getMenuGroupIdByScreenId(int $screenId): ?int
    {
        $list = $this->groupList;

        foreach ($list as $group) {
            if (!is_null($group->getCategoryByScreenId($screenId))) {
                return $group->getMenuGroupId();
            }
        }

        return null;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

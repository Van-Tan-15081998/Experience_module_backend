<?php

namespace App\Lib\Business\App\Admin\Common\Models;

use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;

class ScreenModel
{
    private int $screenId;
    private string $functionTitle;
    private string $screenTitle;
    private ?RoleFunctionModel $role;
    private ?MenuGroupModel $menuGroup;

    /**
     * @return int
     */
    public function getScreenId(): int
    {
        return $this->screenId;
    }

    /**
     * @param int $screenId
     */
    public function setScreenId(int $screenId): void
    {
        $this->screenId = $screenId;
    }

    /**
     * @return string
     */
    public function getFunctionTitle(): string
    {
        return $this->functionTitle;
    }

    /**
     * @param string $functionTitle
     */
    public function setFunctionTitle(string $functionTitle): void
    {
        $this->functionTitle = $functionTitle;
    }

    /**
     * @return string
     */
    public function getScreenTitle(): string
    {
        return $this->screenTitle;
    }

    /**
     * @param string $screenTitle
     */
    public function setScreenTitle(string $screenTitle): void
    {
        $this->screenTitle = $screenTitle;
    }

    /**
     * @return RoleFunctionModel|null
     */
    public function getRole(): ?RoleFunctionModel
    {
        return $this->role;
    }

    /**
     * @param RoleFunctionModel|null $role
     */
    public function setRole(?RoleFunctionModel $role): void
    {
        $this->role = $role;
    }

    /**
     * @return MenuGroupModel|null
     */
    public function getMenuGroup(): ?MenuGroupModel
    {
        return $this->menuGroup;
    }

    /**
     * @param MenuGroupModel|null $menuGroup
     */
    public function setMenuGroup(?MenuGroupModel $menuGroup): void
    {
        $this->menuGroup = $menuGroup;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

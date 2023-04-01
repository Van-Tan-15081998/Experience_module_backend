<?php

namespace App\Lib\Business\App\Admin\Common\Models;

class MenuModel
{
    private int $menuId;
    private string $name;
    private string $url;
    private int $sequence;
    private int $functionId;
    private int $screenId;

    /**
     * @return int
     */
    public function getMenuId(): int
    {
        return $this->menuId;
    }

    /**
     * @param int $menuId
     */
    public function setMenuId(int $menuId): void
    {
        $this->menuId = $menuId;
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
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
     * @return int
     */
    public function getFunctionId(): int
    {
        return $this->functionId;
    }

    /**
     * @param int $functionId
     */
    public function setFunctionId(int $functionId): void
    {
        $this->functionId = $functionId;
    }

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

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

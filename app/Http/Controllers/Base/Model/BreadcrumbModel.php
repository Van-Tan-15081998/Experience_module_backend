<?php

namespace App\Http\Controllers\Base\Model;

class BreadcrumbModel
{
    private string $label;
    private bool $isTitle = false;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isTitle(): bool
    {
        return $this->isTitle;
    }

    /**
     * @param bool $isTitle
     */
    public function setIsTitle(bool $isTitle): void
    {
        $this->isTitle = $isTitle;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

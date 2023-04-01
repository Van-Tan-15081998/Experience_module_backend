<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeObject;

class FooterModel extends DreamerTypeObject
{
    private string $copyright;

    /**
     * @return string
     */
    public function getCopyright(): string
    {
        return $this->copyright;
    }

    /**
     * @param string $copyright
     */
    public function setCopyright(string $copyright): void
    {
        $this->copyright = $copyright;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

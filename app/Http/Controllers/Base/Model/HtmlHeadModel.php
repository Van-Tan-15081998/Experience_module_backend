<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeObject;

class HtmlHeadModel extends DreamerTypeObject
{
    private string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

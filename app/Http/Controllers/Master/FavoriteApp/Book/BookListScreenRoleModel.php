<?php

namespace App\Http\Controllers\Master\FavoriteApp\Book;

use App\Http\Controllers\Base\FavoriteApp\Book\Models\BookScreenRoleModel;

class BookListScreenRoleModel extends BookScreenRoleModel
{
    private bool $isBrowserForDetail;

    /**
     * @return bool
     */
    public function isBrowserForDetail(): bool
    {
        return $this->isBrowserForDetail;
    }

    /**
     * @param bool $isBrowserForDetail
     */
    public function setIsBrowserForDetail(bool $isBrowserForDetail): void
    {
        $this->isBrowserForDetail = $isBrowserForDetail;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $myTarget = parent::toArrayFromModel($target);

        $parentTarget = parent::toArray();

        return array_merge($parentTarget, $myTarget);
    }
}

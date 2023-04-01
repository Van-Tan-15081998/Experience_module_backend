<?php

namespace App\Http\Controllers\Base\Model;

use App\Lib\Common\Type\DreamerTypeObject;

class ScreenRoleModel extends DreamerTypeObject
{
    private bool $isBrowse;
    private bool $isRegistration;
    private bool $isEdit;
    private bool $isDelete;
    private bool $isUpload;
    private bool $isDownload;

    public function noRole(): void
    {
        $this->isBrowse = false;
        $this->isRegistration = false;
        $this->isEdit = false;
        $this->isDelete = false;
        $this->isUpload = false;
        $this->isDownload = false;
    }

    /**
     * @return bool
     */
    public function isBrowse(): bool
    {
        return $this->isBrowse;
    }

    /**
     * @param bool $isBrowse
     */
    public function setIsBrowse(bool $isBrowse): void
    {
        $this->isBrowse = $isBrowse;
    }

    /**
     * @return bool
     */
    public function isRegistration(): bool
    {
        return $this->isRegistration;
    }

    /**
     * @param bool $isRegistration
     */
    public function setIsRegistration(bool $isRegistration): void
    {
        $this->isRegistration = $isRegistration;
    }

    /**
     * @return bool
     */
    public function isEdit(): bool
    {
        return $this->isEdit;
    }

    /**
     * @param bool $isEdit
     */
    public function setIsEdit(bool $isEdit): void
    {
        $this->isEdit = $isEdit;
    }

    /**
     * @return bool
     */
    public function isDelete(): bool
    {
        return $this->isDelete;
    }

    /**
     * @param bool $isDelete
     */
    public function setIsDelete(bool $isDelete): void
    {
        $this->isDelete = $isDelete;
    }

    /**
     * @return bool
     */
    public function isUpload(): bool
    {
        return $this->isUpload;
    }

    /**
     * @param bool $isUpload
     */
    public function setIsUpload(bool $isUpload): void
    {
        $this->isUpload = $isUpload;
    }

    /**
     * @return bool
     */
    public function isDownload(): bool
    {
        return $this->isDownload;
    }

    /**
     * @param bool $isDownload
     */
    public function setIsDownload(bool $isDownload): void
    {
        $this->isDownload = $isDownload;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

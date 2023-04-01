<?php

namespace App\Lib\Business\Specific\Staff\AccountRole\Models;

class RoleFunctionModel
{
    private int $functionId;
    private int $screenId;
    private string $functionName;
    private string $screenName;
    private bool $isBrowser;
    private bool $isRegistration;
    private bool $isEdit;
    private bool $isDelete;
    private bool $isUpload;
    private bool $isDownload;

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

    /**
     * @return string
     */
    public function getFunctionName(): string
    {
        return $this->functionName;
    }

    /**
     * @param string $functionName
     */
    public function setFunctionName(string $functionName): void
    {
        $this->functionName = $functionName;
    }

    /**
     * @return string
     */
    public function getScreenName(): string
    {
        return $this->screenName;
    }

    /**
     * @param string $screenName
     */
    public function setScreenName(string $screenName): void
    {
        $this->screenName = $screenName;
    }

    /**
     * @return bool
     */
    public function isBrowser(): bool
    {
        return $this->isBrowser;
    }

    /**
     * @param bool $isBrowse
     */
    public function setIsBrowser(bool $isBrowser): void
    {
        $this->isBrowser = $isBrowser;
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

    public function merge(RoleFunctionModel $adminRole): void
    {
        if($adminRole->isBrowse()) {
            $this->isBrowse = true;
        }

        if($adminRole->isRegistration()) {
            $this->isRegistration = true;
        }

        if($adminRole->isEdit()) {
            $this->isEdit = true;
        }

        if($adminRole->isDelete()) {
            $this->isDelete = true;
        }

        if($adminRole->isUpload()) {
            $this->isUpload = true;
        }

        if($adminRole->isDownload()) {
            $this->isDownload = true;
        }
    }

    public static function createFromRecord($record): RoleFunctionModel
    {
        $model = new RoleFunctionModel();

        $model->functionId      = $record->function_id;
        $model->screenId        = $record->screen_id;
        $model->functionName    = $record->name;
        $model->screenName      = $record->screen_name;
        $model->isBrowser       = $record->is_browser;
        $model->isRegistration  = $record->is_registration;
        $model->isEdit          = $record->is_edit;
        $model->isDelete        = $record->is_delete;
        $model->isUpload        = $record->is_upload;
        $model->isDownload      = $record->is_download;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}


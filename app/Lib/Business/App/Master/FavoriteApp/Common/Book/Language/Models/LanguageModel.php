<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class LanguageModel extends DreamerTypeObject
{
    private int         $languageId;
    private string      $name;

    private ?int        $createdAccountId;
    private ?int        $createdAccountLoginId;
    private string      $createdAccountName;
    private string      $createdDatetime;
    private ?int        $updatedAccountId;
    private ?int        $updatedAccountLoginId;
    private string      $updatedAccountName;
    private string      $updatedDatetime;
    private ?int        $recordVersion;
    private ?bool       $isDeleted;

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
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
     * @return int|null
     */
    public function getCreatedAccountId(): ?int
    {
        return $this->createdAccountId;
    }

    /**
     * @param int|null $createdAccountId
     */
    public function setCreatedAccountId(?int $createdAccountId): void
    {
        $this->createdAccountId = $createdAccountId;
    }

    /**
     * @return int|null
     */
    public function getCreatedAccountLoginId(): ?int
    {
        return $this->createdAccountLoginId;
    }

    /**
     * @param int|null $createdAccountLoginId
     */
    public function setCreatedAccountLoginId(?int $createdAccountLoginId): void
    {
        $this->createdAccountLoginId = $createdAccountLoginId;
    }

    /**
     * @return string
     */
    public function getCreatedAccountName(): string
    {
        return $this->createdAccountName;
    }

    /**
     * @param string $createdAccountName
     */
    public function setCreatedAccountName(string $createdAccountName): void
    {
        $this->createdAccountName = $createdAccountName;
    }

    /**
     * @return string
     */
    public function getCreatedDatetime(): string
    {
        return $this->createdDatetime;
    }

    /**
     * @param string $createdDatetime
     */
    public function setCreatedDatetime(string $createdDatetime): void
    {
        $this->createdDatetime = $createdDatetime;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAccountId(): ?int
    {
        return $this->updatedAccountId;
    }

    /**
     * @param int|null $updatedAccountId
     */
    public function setUpdatedAccountId(?int $updatedAccountId): void
    {
        $this->updatedAccountId = $updatedAccountId;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAccountLoginId(): ?int
    {
        return $this->updatedAccountLoginId;
    }

    /**
     * @param int|null $updatedAccountLoginId
     */
    public function setUpdatedAccountLoginId(?int $updatedAccountLoginId): void
    {
        $this->updatedAccountLoginId = $updatedAccountLoginId;
    }

    /**
     * @return string
     */
    public function getUpdatedAccountName(): string
    {
        return $this->updatedAccountName;
    }

    /**
     * @param string $updatedAccountName
     */
    public function setUpdatedAccountName(string $updatedAccountName): void
    {
        $this->updatedAccountName = $updatedAccountName;
    }

    /**
     * @return string
     */
    public function getUpdatedDatetime(): string
    {
        return $this->updatedDatetime;
    }

    /**
     * @param string $updatedDatetime
     */
    public function setUpdatedDatetime(string $updatedDatetime): void
    {
        $this->updatedDatetime = $updatedDatetime;
    }

    /**
     * @return int|null
     */
    public function getRecordVersion(): ?int
    {
        return $this->recordVersion;
    }

    /**
     * @param int|null $recordVersion
     */
    public function setRecordVersion(?int $recordVersion): void
    {
        $this->recordVersion = $recordVersion;
    }

    /**
     * @return bool|null
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool|null $isDeleted
     */
    public function setIsDeleted(?bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    public static function createFromRecord($record): LanguageModel
    {
        $model = new LanguageModel();

        $model->languageId = $record->language_id;
        $model->name           = $record->name;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

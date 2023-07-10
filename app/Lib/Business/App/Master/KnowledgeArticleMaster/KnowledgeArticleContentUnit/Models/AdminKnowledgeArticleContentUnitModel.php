<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class AdminKnowledgeArticleContentUnitModel extends DreamerTypeObject
{
    private int             $knowledgeArticleContentUnitId;
    private string          $title;
    private string          $unitContent;
    private int             $sequence;

    private ?int            $createdAccountId;
    private ?int            $createdAccountLoginId;
    private ?string         $createdAccountName;
    private ?string         $createdDatetime;
    private ?int            $updatedAccountId;
    private ?int            $updatedAccountLoginId;
    private ?string         $updatedAccountName;
    private ?string         $updatedDatetime;
    private ?int            $recordVersion;
    private ?bool           $isDeleted;

    /**
     * @return int
     */
    public function getKnowledgeArticleContentUnitId(): int
    {
        return $this->knowledgeArticleContentUnitId;
    }

    /**
     * @param int $knowledgeArticleContentUnitId
     */
    public function setKnowledgeArticleContentUnitId(int $knowledgeArticleContentUnitId): void
    {
        $this->knowledgeArticleContentUnitId = $knowledgeArticleContentUnitId;
    }

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

    /**
     * @return string
     */
    public function getUnitContent(): string
    {
        return $this->unitContent;
    }

    /**
     * @param string $unitContent
     */
    public function setUnitContent(string $unitContent): void
    {
        $this->unitContent = $unitContent;
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
     * @return string|null
     */
    public function getCreatedAccountName(): ?string
    {
        return $this->createdAccountName;
    }

    /**
     * @param string|null $createdAccountName
     */
    public function setCreatedAccountName(?string $createdAccountName): void
    {
        $this->createdAccountName = $createdAccountName;
    }

    /**
     * @return string|null
     */
    public function getCreatedDatetime(): ?string
    {
        return $this->createdDatetime;
    }

    /**
     * @param string|null $createdDatetime
     */
    public function setCreatedDatetime(?string $createdDatetime): void
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
     * @return string|null
     */
    public function getUpdatedAccountName(): ?string
    {
        return $this->updatedAccountName;
    }

    /**
     * @param string|null $updatedAccountName
     */
    public function setUpdatedAccountName(?string $updatedAccountName): void
    {
        $this->updatedAccountName = $updatedAccountName;
    }

    /**
     * @return string|null
     */
    public function getUpdatedDatetime(): ?string
    {
        return $this->updatedDatetime;
    }

    /**
     * @param string|null $updatedDatetime
     */
    public function setUpdatedDatetime(?string $updatedDatetime): void
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

    public function init(): void
    {
        $this->title                   = 'Title mẫu nha';
        $this->unitContent             = 'Content mẫu nha';
        $this->sequence                = 1;

        $this->createdAccountId        = null;
        $this->createdAccountLoginId   = null;
        $this->createdAccountName      = '';
        $this->createdDatetime         = '';
        $this->updatedAccountId        = null;
        $this->updatedAccountLoginId   = null;
        $this->updatedAccountName      = '';
        $this->updatedDatetime         = '';
        $this->recordVersion           = null;
        $this->isDeleted               = null;
    }

    public static function createFromRecord($record): AdminKnowledgeArticleContentUnitModel {
        $model = new AdminKnowledgeArticleContentUnitModel();

        $model->knowledgeArticleContentUnitId      = $record->knowledge_article_content_unit_id;
        $model->title                   = $record->title;
        $model->unitContent             = $record->unit_content;
        $model->sequence                = $record->sequence;

        $model->createdAccountId        = $record->created_account_id;
        $model->createdAccountLoginId   = $record->created_account_login_id;
        $model->createdAccountName      = $record->created_account_name;
        $model->createdDatetime         = $record->created_datetime;
        $model->updatedAccountId        = $record->updated_account_id;
        $model->updatedAccountLoginId   = $record->updated_account_login_id;
        $model->updatedAccountName      = $record->updated_account_name;
        $model->updatedDatetime         = $record->updated_datetime;
        $model->recordVersion           = $record->record_version;
        $model->isDeleted               = $record->is_deleted;

        return $model;
    }

    public static function createFromRecordForEdit($record): AdminKnowledgeArticleContentUnitModel {
        $model = new AdminKnowledgeArticleContentUnitModel();

        $model->knowledgeArticleContentUnitId      = $record->knowledge_article_content_unit_id;
        $model->title                   = $record->title;
        $model->unitContent                 = $record->unit_content;
        $model->sequence                = $record->sequence;

        $model->createdAccountId        = $record->created_account_id;
        $model->createdAccountLoginId   = $record->created_account_login_id;
        $model->createdAccountName      = $record->created_account_name;
        $model->createdDatetime         = $record->created_datetime;
        $model->updatedAccountId        = $record->updated_account_id;
        $model->updatedAccountLoginId   = $record->updated_account_login_id;
        $model->updatedAccountName      = $record->updated_account_name;
        $model->updatedDatetime         = $record->updated_datetime;
        $model->recordVersion           = $record->record_version;
        $model->isDeleted               = $record->is_deleted;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

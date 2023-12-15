<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class AdminTagModel  extends DreamerTypeObject
{
    private int             $tagId;
    private string          $title;
    private string          $color;
    private int             $level;
    private int             $sequence;

    // Id bảng trung gian khi lấy tag list
    private int             $tagKnowledgeArticleId;

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
    public function getTagId(): int
    {
        return $this->tagId;
    }

    /**
     * @param int $tagId
     */
    public function setTagId(int $tagId): void
    {
        $this->tagId = $tagId;
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
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
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

    /**
     * @return int
     */
    public function getTagKnowledgeArticleId(): int
    {
        return $this->tagKnowledgeArticleId;
    }

    /**
     * @param int $tagKnowledgeArticleId
     */
    public function setTagKnowledgeArticleId(int $tagKnowledgeArticleId): void
    {
        $this->tagKnowledgeArticleId = $tagKnowledgeArticleId;
    }

    public function init(): void
    {
        $this->title                   = 'Title mẫu nha';
        $this->color                    = '';
        $this->level                    = 1;
        $this->sequence                 = 1;

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

    public static function createFromRecord($record): AdminTagModel {
        $model = new AdminTagModel();

        $model->tagId               = $record->tag_id;
        $model->title                   = $record->title;
        $model->color                   = $record->color;
        $model->level                   = $record->level;
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

    public static function createFromRecordForEdit($record): AdminTagModel {
        $model = new AdminTagModel();

        $model->tagId               = $record->tag_id;
        $model->title                   = $record->title;
        $model->color                   = $record->color;
        $model->level                   = $record->level;
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

    public static function createFromRecordSpecial($record): AdminTagModel {
        $model = new AdminTagModel();

        $model->tagId               = $record->tag_id;
        $model->title                   = $record->title;
        $model->color                   = $record->color;
        $model->level                   = $record->level;
        $model->sequence                = $record->sequence;

        $model->tagKnowledgeArticleId = $record->tag_knowledge_article_allocation_id;

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

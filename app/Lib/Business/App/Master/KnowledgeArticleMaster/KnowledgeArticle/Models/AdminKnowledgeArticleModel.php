<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models;

use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;

class AdminKnowledgeArticleModel extends DreamerTypeObject
{
    private int             $knowledgeArticleId;
    private string          $title;

//    private int             $subjectId;

    private DreamerTypeList $unitContentList;
    private DreamerTypeList $tagList;

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
    public function getKnowledgeArticleId(): int
    {
        return $this->knowledgeArticleId;
    }

    /**
     * @param int $knowledgeArticleId
     */
    public function setKnowledgeArticleId(int $knowledgeArticleId): void
    {
        $this->knowledgeArticleId = $knowledgeArticleId;
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
     * @return DreamerTypeList
     */
    public function getUnitContentList(): DreamerTypeList
    {
        return $this->unitContentList;
    }

    /**
     * @param DreamerTypeList $unitContentList
     */
    public function setUnitContentList(DreamerTypeList $unitContentList): void
    {
        $this->unitContentList = $unitContentList;
    }

//    /**
//     * @return int
//     */
//    public function getSubjectId(): int
//    {
//        return $this->subjectId;
//    }
//
//    /**
//     * @param int $subjectId
//     */
//    public function setSubjectId(int $subjectId): void
//    {
//        $this->subjectId = $subjectId;
//    }



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
     * @return DreamerTypeList
     */
    public function getTagList(): DreamerTypeList
    {
        return $this->tagList;
    }

    /**
     * @param DreamerTypeList $tagList
     */
    public function setTagList(DreamerTypeList $tagList): void
    {
        $this->tagList = $tagList;
    }

    public function init(): void
    {
        $this->title                   = 'Title mẫu nha';

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

    public static function createFromRecord($record): AdminKnowledgeArticleModel {
        $model = new AdminKnowledgeArticleModel();

        $model->knowledgeArticleId      = $record->knowledge_article_id;
        $model->title                   = $record->title;

//        $model->subjectId               = $record->subject_id;

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

    public static function createFromRecordForEdit($record): AdminKnowledgeArticleModel {
        $model = new AdminKnowledgeArticleModel();

        $model->knowledgeArticleId      = $record->knowledge_article_id;
        $model->title                   = $record->title;

//        $model->subjectId               = $record->subject_id;

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

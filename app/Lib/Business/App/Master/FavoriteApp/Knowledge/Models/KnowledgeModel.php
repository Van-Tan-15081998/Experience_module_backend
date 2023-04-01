<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models;

class KnowledgeModel
{
    private int $knowledgeId;

    private string $title;

    private string $content;

    private string $citationSource;

    private int $sameLevelSequence;

    private int $parentKnowledgeCode;

    private int $subjectCode;

    private string $picture;

    private bool $isImportant;

    private string $borderColor;

    private bool $isFavourite;

    private string $sizePicture;

    private int $childrenCount;

    private int $treeLevel;

    /**
     * @return int
     */
    public function getKnowledgeId(): int
    {
        return $this->knowledgeId;
    }

    /**
     * @param int $knowledgeId
     */
    public function setKnowledgeId(int $knowledgeId): void
    {
        $this->knowledgeId = $knowledgeId;
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
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getCitationSource(): string
    {
        return $this->citationSource;
    }

    /**
     * @param string $citationSource
     */
    public function setCitationSource(string $citationSource): void
    {
        $this->citationSource = $citationSource;
    }

    /**
     * @return int
     */
    public function getSameLevelSequence(): int
    {
        return $this->sameLevelSequence;
    }

    /**
     * @param int $sameLevelSequence
     */
    public function setSameLevelSequence(int $sameLevelSequence): void
    {
        $this->sameLevelSequence = $sameLevelSequence;
    }

    /**
     * @return int
     */
    public function getParentKnowledgeCode(): int
    {
        return $this->parentKnowledgeCode;
    }

    /**
     * @param int $parentKnowledgeCode
     */
    public function setParentKnowledgeCode(int $parentKnowledgeCode): void
    {
        $this->parentKnowledgeCode = $parentKnowledgeCode;
    }

    /**
     * @return int
     */
    public function getSubjectCode(): int
    {
        return $this->subjectCode;
    }

    /**
     * @param int $subjectCode
     */
    public function setSubjectCode(int $subjectCode): void
    {
        $this->subjectCode = $subjectCode;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return bool
     */
    public function isImportant(): bool
    {
        return $this->isImportant;
    }

    /**
     * @param bool $isImportant
     */
    public function setIsImportant(bool $isImportant): void
    {
        $this->isImportant = $isImportant;
    }

    /**
     * @return string
     */
    public function getBorderColor(): string
    {
        return $this->borderColor;
    }

    /**
     * @param string $borderColor
     */
    public function setBorderColor(string $borderColor): void
    {
        $this->borderColor = $borderColor;
    }

    /**
     * @return bool
     */
    public function isFavourite(): bool
    {
        return $this->isFavourite;
    }

    /**
     * @param bool $isFavourite
     */
    public function setIsFavourite(bool $isFavourite): void
    {
        $this->isFavourite = $isFavourite;
    }

    /**
     * @return string
     */
    public function getSizePicture(): string
    {
        return $this->sizePicture;
    }

    /**
     * @param string $sizePicture
     */
    public function setSizePicture(string $sizePicture): void
    {
        $this->sizePicture = $sizePicture;
    }

    /**
     * @return int
     */
    public function getChildrenCount(): int
    {
        return $this->childrenCount;
    }

    /**
     * @return int
     */
    public function getTreeLevel(): int
    {
        return $this->treeLevel;
    }

    /**
     * @param int $treeLevel
     */
    public function setTreeLevel(int $treeLevel): void
    {
        $this->treeLevel = $treeLevel;
    }

    /**
     * @param int $childrenCount
     */
    public function setChildrenCount(int $childrenCount): void
    {
        $this->childrenCount = $childrenCount;
    }

    public static function createFromRecord($record): KnowledgeModel {
        $model = new KnowledgeModel();

        $model->knowledgeId             = $record->knowledge_id;
        $model->title                   = $record->title;
        $model->content                 = $record->content;
        $model->citationSource          = $record->citation_source;
        $model->sameLevelSequence       = $record->same_level_sequence;
        $model->parentKnowledgeCode     = $record->parent_knowledge_code;
        $model->subjectCode             = $record->subject_code;
        $model->picture                 = $record->picture;
        $model->isImportant             = $record->is_important;
        $model->borderColor             = $record->border_color;
        $model->isFavourite             = $record->is_favourite;
        $model->sizePicture             = $record->size_picture;
        $model->treeLevel               = $record->tree_level;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

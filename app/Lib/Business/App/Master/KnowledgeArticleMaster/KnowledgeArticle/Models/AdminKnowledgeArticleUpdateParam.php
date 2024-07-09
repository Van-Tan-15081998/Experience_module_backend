<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models;

use App\Lib\Common\Type\DreamerTypeList;

class AdminKnowledgeArticleUpdateParam
{
    private ?int        $knowledgeArticleId = null;

    private string      $title;

    private string      $coverImage;

    private int         $subjectId;

    private  DreamerTypeList $knowledgeArticleTagList;

    /**
     * @return int|null
     */
    public function getKnowledgeArticleId(): ?int
    {
        return $this->knowledgeArticleId;
    }

    /**
     * @param int|null $knowledgeArticleId
     */
    public function setKnowledgeArticleId(?int $knowledgeArticleId): void
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
     * @return string
     */
    public function getCoverImage(): string
    {
        return $this->coverImage;
    }

    /**
     * @param string $coverImage
     */
    public function setCoverImage(string $coverImage): void
    {
        $this->coverImage = $coverImage;
    }

    /**
     * @return int
     */
    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    /**
     * @param int $subjectId
     */
    public function setSubjectId(int $subjectId): void
    {
        $this->subjectId = $subjectId;
    }

    /**
     * @return DreamerTypeList
     */
    public function getKnowledgeArticleTagList(): DreamerTypeList
    {
        return $this->knowledgeArticleTagList;
    }

    /**
     * @param DreamerTypeList $knowledgeArticleTagList
     */
    public function setKnowledgeArticleTagList(DreamerTypeList $knowledgeArticleTagList): void
    {
        $this->knowledgeArticleTagList = $knowledgeArticleTagList;
    }
}

<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models;

use App\Lib\Common\Type\DreamerTypeList;

class AdminKnowledgeArticleContentUnitNewParam
{
    private ?int        $knowledgeArticleId = null;

    private string      $title;

    private string      $unitContent;

    private DreamerTypeList $imageList;

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
     * @return DreamerTypeList
     */
    public function getImageList(): DreamerTypeList
    {
        return $this->imageList;
    }

    /**
     * @param DreamerTypeList $imageList
     */
    public function setImageList(DreamerTypeList $imageList): void
    {
        $this->imageList = $imageList;
    }

}

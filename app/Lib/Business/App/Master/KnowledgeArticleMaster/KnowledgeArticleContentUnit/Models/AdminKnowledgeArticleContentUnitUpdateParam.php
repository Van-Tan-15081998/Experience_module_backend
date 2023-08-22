<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models;

use App\Lib\Common\Type\DreamerTypeList;

class AdminKnowledgeArticleContentUnitUpdateParam
{
    private ?int        $knowledgeArticleContentUnitId = null;

    private string      $title;

    private string      $unitContent;
    private string      $unitContentRightSide;
    private string      $unitContentLeftSide;

    private DreamerTypeList $imageList;


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
     * @return int|null
     */
    public function getKnowledgeArticleContentUnitId(): ?int
    {
        return $this->knowledgeArticleContentUnitId;
    }

    /**
     * @param int|null $knowledgeArticleContentUnitId
     */
    public function setKnowledgeArticleContentUnitId(?int $knowledgeArticleContentUnitId): void
    {
        $this->knowledgeArticleContentUnitId = $knowledgeArticleContentUnitId;
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
     * @return string
     */
    public function getUnitContentRightSide(): string
    {
        return $this->unitContentRightSide;
    }

    /**
     * @param string $unitContentRightSide
     */
    public function setUnitContentRightSide(string $unitContentRightSide): void
    {
        $this->unitContentRightSide = $unitContentRightSide;
    }

    /**
     * @return string
     */
    public function getUnitContentLeftSide(): string
    {
        return $this->unitContentLeftSide;
    }

    /**
     * @param string $unitContentLeftSide
     */
    public function setUnitContentLeftSide(string $unitContentLeftSide): void
    {
        $this->unitContentLeftSide = $unitContentLeftSide;
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

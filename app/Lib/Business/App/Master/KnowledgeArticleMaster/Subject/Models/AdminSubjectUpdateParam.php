<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models;

use App\Lib\Common\Type\DreamerTypeList;

class AdminSubjectUpdateParam
{
    private ?int        $subjectId = null;

    private string      $title;
    private int         $level;
    private int         $sequence;

    private DreamerTypeList $parentSubjectList;

    private DreamerTypeList $branchSubjectList;
    private DreamerTypeList $knowledgeArticleList;

    /**
     * @return int|null
     */
    public function getSubjectId(): ?int
    {
        return $this->subjectId;
    }

    /**
     * @param int|null $subjectId
     */
    public function setSubjectId(?int $subjectId): void
    {
        $this->subjectId = $subjectId;
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
     * @return DreamerTypeList
     */
    public function getParentSubjectList(): DreamerTypeList
    {
        return $this->parentSubjectList;
    }

    /**
     * @param DreamerTypeList $parentSubjectList
     */
    public function setParentSubjectList(DreamerTypeList $parentSubjectList): void
    {
        $this->parentSubjectList = $parentSubjectList;
    }

    /**
     * @return DreamerTypeList
     */
    public function getBranchSubjectList(): DreamerTypeList
    {
        return $this->branchSubjectList;
    }

    /**
     * @param DreamerTypeList $branchSubjectList
     */
    public function setBranchSubjectList(DreamerTypeList $branchSubjectList): void
    {
        $this->branchSubjectList = $branchSubjectList;
    }

    /**
     * @return DreamerTypeList
     */
    public function getKnowledgeArticleList(): DreamerTypeList
    {
        return $this->knowledgeArticleList;
    }

    /**
     * @param DreamerTypeList $knowledgeArticleList
     */
    public function setKnowledgeArticleList(DreamerTypeList $knowledgeArticleList): void
    {
        $this->knowledgeArticleList = $knowledgeArticleList;
    }
}

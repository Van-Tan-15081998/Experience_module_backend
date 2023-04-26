<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models;

class AdminSubjectUpdateParam
{
    private ?int        $subjectId = null;

    private string      $title;
    private int         $level;
    private int         $sequence;
    private int         $parentSubjectCode;
    private int         $rootSubjectCode;

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
     * @return int
     */
    public function getParentSubjectCode(): int
    {
        return $this->parentSubjectCode;
    }

    /**
     * @param int $parentSubjectCode
     */
    public function setParentSubjectCode(int $parentSubjectCode): void
    {
        $this->parentSubjectCode = $parentSubjectCode;
    }

    /**
     * @return int
     */
    public function getRootSubjectCode(): int
    {
        return $this->rootSubjectCode;
    }

    /**
     * @param int $rootSubjectCode
     */
    public function setRootSubjectCode(int $rootSubjectCode): void
    {
        $this->rootSubjectCode = $rootSubjectCode;
    }


}

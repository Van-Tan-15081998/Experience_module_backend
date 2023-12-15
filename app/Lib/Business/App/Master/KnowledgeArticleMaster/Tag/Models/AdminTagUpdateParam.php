<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models;

class AdminTagUpdateParam
{
    private ?int        $tagId = null;

    private string      $title;
    private string      $color;
    private int         $level;
    private int         $sequence;

    /**
     * @return int|null
     */
    public function getTagId(): ?int
    {
        return $this->tagId;
    }

    /**
     * @param int|null $subjectId
     */
    public function setTagId(?int $tagId): void
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


}

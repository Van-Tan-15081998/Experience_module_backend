<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class AdminDefaultTagColorModel  extends DreamerTypeObject
{
    private int             $defaultTagColorId;
    private string          $color;
    private bool             $isUsed;

    /**
     * @return int
     */
    public function getDefaultTagColorId(): int
    {
        return $this->defaultTagColorId;
    }

    /**
     * @param int $defaultTagColorId
     */
    public function setDefaultTagColorId(int $defaultTagColorId): void
    {
        $this->defaultTagColorId = $defaultTagColorId;
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
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->isUsed;
    }

    /**
     * @param bool $isUsed
     */
    public function setIsUsed(bool $isUsed): void
    {
        $this->isUsed = $isUsed;
    }

    public static function createFromRecord($record): AdminDefaultTagColorModel {
        $model = new AdminDefaultTagColorModel();

        $model->defaultTagColorId               = $record->tag_default_color_id;
        $model->color                   = $record->color;
        $model->isUsed                   = $record->is_used;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

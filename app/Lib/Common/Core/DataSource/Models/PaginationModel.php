<?php

namespace App\Lib\Common\Core\DataSource\Models;

use App\Lib\Common\Type\DreamerTypeObject;

abstract class PaginationModel extends DreamerTypeObject
{
    private PaginationInfo $paginationInfo;
    private array $list;

    public function __construct()
    {
    }

    abstract function convertResult(array $result): void;

    /**
     * @return PaginationInfo
     */
    public function getPaginationInfo(): PaginationInfo
    {
        return $this->paginationInfo;
    }

    /**
     * @param PaginationInfo $paginationInfo
     */
    public function setPaginationInfo(PaginationInfo $paginationInfo): void
    {
        $this->paginationInfo = $paginationInfo;
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param array $list
     */
    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return parent::toArrayFromModel($target);
    }
}

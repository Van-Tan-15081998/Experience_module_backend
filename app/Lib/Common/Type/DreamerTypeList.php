<?php

namespace App\Lib\Common\Type;

class DreamerTypeList extends DreamerTypeObject
{
    private array $list = array();

    public function __construct(array $list = null)
    {
        parent::__construct();

        if($list != null)
        {
            $this->setList($list);
        }
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

    public function empty(): bool
    {
        return empty($this->list);
    }

    public function add($val) : void
    {
        $this->list[] = $val;
    }

    public function get(int $index)
    {
        return ($this->list[$index] ?? null);
    }

    public function addList(array $list) : void
    {
        foreach($list as $item)
        {
            $this->add($item);
        }
    }

    public function count() : int
    {
        return count($this->list);
    }

    public function removeAll(): void
    {
        unset($this->list);
        $this->list = array();
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return parent::toArrayFromModel($this->list);
    }
}

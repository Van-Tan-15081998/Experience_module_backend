<?php

namespace App\Lib\Common\Core\DataSource\Models;

class PageInfo
{
    private int $startPage;
    private int $limitCount;

    public function __construct(int $startPage = 1, int $limitCount = 10)

    {
        $this->setStartPage($startPage);
        $this->setLimitCount($limitCount);
    }

    /**
     * @return int
     */
    public function getStartPage(): int
    {
        return $this->startPage;
    }

    /**
     * @param int $startPage
     */
    public function setStartPage(int $startPage): void
    {
        $this->startPage = $startPage;
    }

    /**
     * @return int
     */
    public function getLimitCount(): int
    {
        return $this->limitCount;
    }

    /**
     * @param int $limitCount
     */
    public function setLimitCount(int $limitCount): void
    {
        $this->limitCount = $limitCount;
    }


}

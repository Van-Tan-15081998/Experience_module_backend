<?php

namespace App\Lib\Common\Core\DataSource\Models;

class PaginationInfo
{
    private int $currentPage;
    private int $totalPages;
    private int $limitCount;
    private int $totalCount;

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
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

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     */
    public function setTotalCount(int $totalCount): void
    {
        $this->totalCount = $totalCount;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book\Models;

use App\Lib\Common\Type\DreamerTypeList;

class AdminBookUpdateParam
{
    private ?int $bookId = null;

    private string $title;

    private DreamerTypeList $publisherList;
    private DreamerTypeList $removePublisherList;

    /**
     * @return int|null
     */
    public function getBookId(): ?int
    {
        return $this->bookId;
    }

    /**
     * @param int|null $bookId
     */
    public function setBookId(?int $bookId): void
    {
        $this->bookId = $bookId;
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
     * @return DreamerTypeList
     */
    public function getPublisherList(): DreamerTypeList
    {
        return $this->publisherList;
    }

    /**
     * @param DreamerTypeList $publisherList
     */
    public function setPublisherList(DreamerTypeList $publisherList): void
    {
        $this->publisherList = $publisherList;
    }

    /**
     * @return DreamerTypeList
     */
    public function getRemovePublisherList(): DreamerTypeList
    {
        return $this->removePublisherList;
    }

    /**
     * @param DreamerTypeList $removePublisherList
     */
    public function setRemovePublisherList(DreamerTypeList $removePublisherList): void
    {
        $this->removePublisherList = $removePublisherList;
    }
}


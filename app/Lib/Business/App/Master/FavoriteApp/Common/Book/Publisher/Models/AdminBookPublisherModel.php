<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class AdminBookPublisherModel extends DreamerTypeObject
{
    /**
     * Model có vai trò như model trung gian liên kết Book và Publisher
     **/

    private int         $bookPublisherId;
    private int         $bookId;
    private int         $publisherId;

    /**
     * @return int
     */
    public function getBookPublisherId(): int
    {
        return $this->bookPublisherId;
    }

    /**
     * @param int $bookPublisherId
     */
    public function setBookPublisherId(int $bookPublisherId): void
    {
        $this->bookPublisherId = $bookPublisherId;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     */
    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return int
     */
    public function getPublisherId(): int
    {
        return $this->publisherId;
    }

    /**
     * @param int $publisherId
     */
    public function setPublisherId(int $publisherId): void
    {
        $this->publisherId = $publisherId;
    }

    public static function createFromRecord($record): AdminBookPublisherModel
    {
        $model = new AdminBookPublisherModel();

        $model->bookPublisherId = $record->book_publisher_allocation_id;
        $model->bookId           = $record->book_id;
        $model->publisherId           = $record->publisher_id;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

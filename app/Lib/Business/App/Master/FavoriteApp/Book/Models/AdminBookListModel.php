<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class AdminBookListModel extends DreamerTypeObject
{
    private int     $bookId;
    private string  $title;
    private int     $authorCode;
    private int     $publisherCode;
    private int     $categoryCode;
    private int     $edition;
    private string  $content;
    private int     $totalPages;
    private int     $formatCode;
    private string  $summary;
    private int     $availability;
    private int     $quantity;
    private int     $price;
    private int     $weight;
    private string  $coverPicture;
    private int     $rating;
    private int     $createdAccountId;
    private int     $createdAccountLoginId;
    private string  $createdAccountName;
    private string  $createdDatetime;
    private int     $updatedAccountId;
    private int     $updatedAccountLoginId;
    private string  $updatedAccountName;
    private string  $updatedDatetime;
    private int     $recordVersion;
    private bool    $isDeleted;

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
    public function getAuthorCode(): int
    {
        return $this->authorCode;
    }

    /**
     * @param int $authorCode
     */
    public function setAuthorCode(int $authorCode): void
    {
        $this->authorCode = $authorCode;
    }

    /**
     * @return int
     */
    public function getPublisherCode(): int
    {
        return $this->publisherCode;
    }

    /**
     * @param int $publisherCode
     */
    public function setPublisherCode(int $publisherCode): void
    {
        $this->publisherCode = $publisherCode;
    }

    /**
     * @return int
     */
    public function getCategoryCode(): int
    {
        return $this->categoryCode;
    }

    /**
     * @param int $categoryCode
     */
    public function setCategoryCode(int $categoryCode): void
    {
        $this->categoryCode = $categoryCode;
    }

    /**
     * @return int
     */
    public function getEdition(): int
    {
        return $this->edition;
    }

    /**
     * @param int $edition
     */
    public function setEdition(int $edition): void
    {
        $this->edition = $edition;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
    public function getFormatCode(): int
    {
        return $this->formatCode;
    }

    /**
     * @param int $formatCode
     */
    public function setFormatCode(int $formatCode): void
    {
        $this->formatCode = $formatCode;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @return int
     */
    public function getAvailability(): int
    {
        return $this->availability;
    }

    /**
     * @param int $availability
     */
    public function setAvailability(int $availability): void
    {
        $this->availability = $availability;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getCoverPicture(): string
    {
        return $this->coverPicture;
    }

    /**
     * @param string $coverPicture
     */
    public function setCoverPicture(string $coverPicture): void
    {
        $this->coverPicture = $coverPicture;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getCreatedAccountId(): int
    {
        return $this->createdAccountId;
    }

    /**
     * @param int $createdAccountId
     */
    public function setCreatedAccountId(int $createdAccountId): void
    {
        $this->createdAccountId = $createdAccountId;
    }

    /**
     * @return int
     */
    public function getCreatedAccountLoginId(): int
    {
        return $this->createdAccountLoginId;
    }

    /**
     * @param int $createdAccountLoginId
     */
    public function setCreatedAccountLoginId(int $createdAccountLoginId): void
    {
        $this->createdAccountLoginId = $createdAccountLoginId;
    }

    /**
     * @return string
     */
    public function getCreatedAccountName(): string
    {
        return $this->createdAccountName;
    }

    /**
     * @param string $createdAccountName
     */
    public function setCreatedAccountName(string $createdAccountName): void
    {
        $this->createdAccountName = $createdAccountName;
    }

    /**
     * @return string
     */
    public function getCreatedDatetime(): string
    {
        return $this->createdDatetime;
    }

    /**
     * @param string $createdDatetime
     */
    public function setCreatedDatetime(string $createdDatetime): void
    {
        $this->createdDatetime = $createdDatetime;
    }

    /**
     * @return int
     */
    public function getUpdatedAccountId(): int
    {
        return $this->updatedAccountId;
    }

    /**
     * @param int $updatedAccountId
     */
    public function setUpdatedAccountId(int $updatedAccountId): void
    {
        $this->updatedAccountId = $updatedAccountId;
    }

    /**
     * @return int
     */
    public function getUpdatedAccountLoginId(): int
    {
        return $this->updatedAccountLoginId;
    }

    /**
     * @param int $updatedAccountLoginId
     */
    public function setUpdatedAccountLoginId(int $updatedAccountLoginId): void
    {
        $this->updatedAccountLoginId = $updatedAccountLoginId;
    }

    /**
     * @return string
     */
    public function getUpdatedAccountName(): string
    {
        return $this->updatedAccountName;
    }

    /**
     * @param string $updatedAccountName
     */
    public function setUpdatedAccountName(string $updatedAccountName): void
    {
        $this->updatedAccountName = $updatedAccountName;
    }

    /**
     * @return string
     */
    public function getUpdatedDatetime(): string
    {
        return $this->updatedDatetime;
    }

    /**
     * @param string $updatedDatetime
     */
    public function setUpdatedDatetime(string $updatedDatetime): void
    {
        $this->updatedDatetime = $updatedDatetime;
    }

    /**
     * @return int
     */
    public function getRecordVersion(): int
    {
        return $this->recordVersion;
    }

    /**
     * @param int $recordVersion
     */
    public function setRecordVersion(int $recordVersion): void
    {
        $this->recordVersion = $recordVersion;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(bool $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    public static function createFromRecord($record): AdminBookListModel {
        $model = new AdminBookListModel();

        $model->bookId                  = $record->book_id;
        $model->title                   = $record->title;
        $model->authorCode              = $record->author_code;
        $model->publisherCode           = $record->publisher_code;
        $model->categoryCode            = $record->category_code;
        $model->edition                 = $record->edition;
        $model->content                 = $record->content;
        $model->totalPages              = $record->total_pages;
        $model->formatCode              = $record->format_code;
        $model->summary                 = $record->summary;
        $model->availability            = $record->availability;
        $model->quantity                = $record->quantity;
        $model->price                   = $record->price;
        $model->weight                  = $record->weight;
        $model->coverPicture            = $record->cover_picture;
        $model->rating                  = $record->rating;
        $model->createdAccountId        = $record->created_account_id;
        $model->createdAccountLoginId   = $record->created_account_login_id;
        $model->createdAccountName      = $record->created_account_name;
        $model->createdDatetime         = $record->created_datetime;
        $model->updatedAccountId        = $record->updated_account_id;
        $model->updatedAccountLoginId   = $record->updated_account_login_id;
        $model->updatedAccountName      = $record->updated_account_name;
        $model->updatedDatetime         = $record->updated_datetime;
        $model->recordVersion           = $record->record_version;
        $model->isDeleted               = $record->is_deleted;

        return $model;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $arrayResult = parent::toArrayFromModel($target);

        return $arrayResult;
    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book\Models;

class AdminBookCondition
{
    private ?string  $title = '';
    private ?int     $authorCode = null;
    private ?int     $publisherCode = null;
    private ?int     $categoryCode = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int|null
     */
    public function getAuthorCode(): ?int
    {
        return $this->authorCode;
    }

    /**
     * @param int|null $authorCode
     */
    public function setAuthorCode(?int $authorCode): void
    {
        $this->authorCode = $authorCode;
    }

    /**
     * @return int|null
     */
    public function getPublisherCode(): ?int
    {
        return $this->publisherCode;
    }

    /**
     * @param int|null $publisherCode
     */
    public function setPublisherCode(?int $publisherCode): void
    {
        $this->publisherCode = $publisherCode;
    }

    /**
     * @return int|null
     */
    public function getCategoryCode(): ?int
    {
        return $this->categoryCode;
    }

    /**
     * @param int|null $categoryCode
     */
    public function setCategoryCode(?int $categoryCode): void
    {
        $this->categoryCode = $categoryCode;
    }


}

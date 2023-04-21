<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book;

use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language\LanguageBusiness;
use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher\PublisherBusiness;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;

class BookCommonBusiness extends ExperienceBaseBusiness
{
    private PublisherBusiness $publisherBusiness;
    private LanguageBusiness $languageBusiness;

    public function __construct() {
        parent::__construct();

        $this->publisherBusiness = App::make(PublisherBusiness::class);
        $this->languageBusiness = App::make(LanguageBusiness::class);
    }

    public function getLanguageList(int $bookId): DreamerTypeList
    {
        return $this->languageBusiness->getLanguageList($bookId);
    }

    public function getPublisherList(): DreamerTypeList
    {
        return$this->publisherBusiness->getPublisherList();
    }

    public function getPublisherListByBookId(int $bookId): DreamerTypeList
    {
        return$this->publisherBusiness->getPublisherListByBookId($bookId);
    }

    public function isValidLanguage(int $languageId): bool
    {
        return $this->languageBusiness->isValid($languageId);
    }

    public function isValidPublisher(int $publisherId): bool
    {
        return $this->publisherBusiness->isValid($publisherId);
    }
}

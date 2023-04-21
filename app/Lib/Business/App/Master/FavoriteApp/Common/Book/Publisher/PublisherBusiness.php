<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher;

use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher\Entities\PublisherEntity;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;

class PublisherBusiness extends ExperienceBaseBusiness
{
    private PublisherEntity $publisherEntity;

    public function __construct() {
        parent::__construct();

        $this->publisherEntity = App::make(PublisherEntity::class);
    }

    public function getPublisherList(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->publisherEntity->getPublisherList();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    public function getPublisherListByBookId(int $bookId): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->publisherEntity->getPublisherListByBookId($bookId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    /**
     * @throws DreamerBusinessException
     */
    public function isValid(int $publisherId): bool
    {
        $isValid = false;

        try {
            $isValid = $this->publisherEntity->isValid($publisherId);
        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if (is_null($isValid)) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $isValid;
    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language;

use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language\Entities\LanguageEntity;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;

class LanguageBusiness extends ExperienceBaseBusiness
{
    private LanguageEntity $languageEntity;

    public function __construct() {
        parent::__construct();

        $this->languageEntity = App::make(LanguageEntity::class);
    }

    public function getLanguageList(int $bookId): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->languageEntity->getLanguageList($bookId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    /**
     * @throws DreamerBusinessException
     */
    public function isValid(int $languageId): bool
    {
        $isValid = false;

        try {
            $isValid = $this->languageEntity->isValid($languageId);
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

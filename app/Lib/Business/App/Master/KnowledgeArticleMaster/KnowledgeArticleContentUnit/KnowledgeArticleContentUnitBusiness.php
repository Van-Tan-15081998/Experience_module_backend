<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Constants\DetailsAction;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\KnowledgeArticleContentUnitListRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\KnowledgeArticleContentUnitNewRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\KnowledgeArticleContentUnitUpdateRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Entities\KnowledgeArticleContentUnitEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitNewParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Common\Exception\DreamerValidationBusinessException;
use App\Lib\Business\Common\Models\DreamerValidationErrors;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KnowledgeArticleContentUnitBusiness extends ExperienceBaseBusiness
{
    private KnowledgeArticleContentUnitEntity $knowledgeArticleContentUnitEntity;

    public function __construct()
    {
        parent::__construct();
        $this->knowledgeArticleContentUnitEntity = App::make(KnowledgeArticleContentUnitEntity::class);
    }

    public function getAll() : array {
        return $this->knowledgeArticleContentUnitEntity->getAll();
    }

    public function getPage(KnowledgeArticleContentUnitListRequest $request): AdminKnowledgeArticleContentUnitPaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount());

        $condition = $request->getSearchCondition();

        return $this->knowledgeArticleContentUnitEntity->getPage($pageInfo, $condition);
    }

    public function getById(DetailsAction $mode, int $knowledgeArticleId): AdminKnowledgeArticleContentUnitModel
    {
        $detail = null;

        if (DetailsAction::VIEW()->equals($mode) || DetailsAction::CONFIRM()->equals($mode)) {
            $detail = $this->knowledgeArticleContentUnitEntity->getById($knowledgeArticleId);
        } elseif (DetailsAction::EDIT()->equals($mode)) {
            $detail = $this->knowledgeArticleContentUnitEntity->getEditKnowledgeArticleContentUnitById($knowledgeArticleId);

        } else {
            // Mode New
            $detail = new AdminKnowledgeArticleContentUnitModel();
            $detail->init();

            return $detail;
        }

        return $detail;
    }


    /**
     * TODO: Add - Start [
     **/
    public function add(KnowledgeArticleContentUnitNewRequest $request): int
    {
        // Get update params
        $newParam = $request->getNewParam();

        // Validate input params
        $errors = $this->validateSaveParams($newParam, $request);
        if (isset($errors)) {
            throw new DreamerValidationBusinessException($errors);
        }

        return $this->_add($newParam);
    }

    private function _add(AdminKnowledgeArticleContentUnitNewParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_insertKnowledgeArticleContentUnit($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _insertKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitNewParam $param): int {

        $isValid = $this->validateNewParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $knowledgeArticleId = $this->knowledgeArticleContentUnitEntity->insertKnowledgeArticleContentUnit($param);

        return $knowledgeArticleId;
    }
    /**
     * TODO: Add - End ]
     **/

    /**
     * TODO: Update - Start [
     **/

    public function update(KnowledgeArticleContentUnitUpdateRequest $request): int
    {
        // Get update params
        $updateParam = $request->getUpdateParam();

        // Validate input params
        $errors = $this->validateSaveParams($updateParam, $request);

        if (isset($errors)) {
            throw new DreamerValidationBusinessException($errors);
        }

        return $this->_update($updateParam);
    }

    private function _update(AdminKnowledgeArticleContentUnitUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_updateKnowledgeArticleContentUnit($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _updateKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $knowledgeArticleContentUnitId = $this->knowledgeArticleContentUnitEntity->updateKnowledgeArticleContentUnit($param);

        return $knowledgeArticleContentUnitId;
    }

    /**
     * TODO: Update - End ]
     **/

    public function getEditSelectionItems(?AdminKnowledgeArticleContentUnitModel $knowledgeArticle): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getNewSelectionItems(): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    private function validateNewParams(AdminKnowledgeArticleContentUnitNewParam $param): bool
    {
        return true;
    }

    private function validateUpdateParams(AdminKnowledgeArticleContentUnitUpdateParam $param): bool
    {
        return true;
    }

    private function validateSaveParams(AdminKnowledgeArticleContentUnitNewParam | AdminKnowledgeArticleContentUnitUpdateParam $param, KnowledgeArticleContentUnitNewRequest | KnowledgeArticleContentUnitUpdateRequest $request): ?DreamerValidationErrors
    {
        //
        $errors = new DreamerValidationErrors();

        if ($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }

    public function getKnowledgeArticleContentUnitListByKnowledgeArticleId(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->knowledgeArticleContentUnitEntity->getKnowledgeArticleContentUnitListByKnowledgeArticleId();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }
}

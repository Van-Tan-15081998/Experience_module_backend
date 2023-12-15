<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle;

use App\Constants\DetailsAction;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle\KnowledgeArticleListRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle\KnowledgeArticleNewRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle\KnowledgeArticleUpdateRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Entities\KnowledgeArticleEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticlePaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleUpdateParam;
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

class KnowledgeArticleBusiness extends ExperienceBaseBusiness
{
    private KnowledgeArticleEntity $knowledgeArticleEntity;

    public function __construct()
    {
        parent::__construct();
        $this->knowledgeArticleEntity = App::make(KnowledgeArticleEntity::class);
    }

    public function getAll() : array {
        return $this->knowledgeArticleEntity->getAll();
    }

    public function getPage(KnowledgeArticleListRequest $request): AdminKnowledgeArticlePaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount());

        $condition = $request->getSearchCondition();

        return $this->knowledgeArticleEntity->getPage($pageInfo, $condition);
    }

    public function getById(DetailsAction $mode, int $knowledgeArticleId): AdminKnowledgeArticleModel
    {
        $detail = null;

        if (DetailsAction::VIEW()->equals($mode) || DetailsAction::CONFIRM()->equals($mode)) {
            $detail = $this->knowledgeArticleEntity->getById($knowledgeArticleId);
        } elseif (DetailsAction::EDIT()->equals($mode)) {
            $detail = $this->knowledgeArticleEntity->getEditKnowledgeArticleById($knowledgeArticleId);

        } else {
            // Mode New
            $detail = new AdminKnowledgeArticleModel();
            $detail->init();

            return $detail;
        }

        // Set Tag List
        $tagList = $this->getTagListByKnowledgeArticleId($detail->getKnowledgeArticleId());
        $detail->setTagList($tagList);

        return $detail;
    }


    /**
     * TODO: Add - Start [
     **/
    public function add(KnowledgeArticleNewRequest $request): int
    {
        // Get update params
        $updateParam = $request->getUpdateParam();

        // Validate input params
        $errors = $this->validateSaveParams($updateParam, $request);
        if (isset($errors)) {
            throw new DreamerValidationBusinessException($errors);
        }

        return $this->_add($updateParam);
    }

    private function _add(AdminKnowledgeArticleUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_insertKnowledgeArticle($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _insertKnowledgeArticle(AdminKnowledgeArticleUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $knowledgeArticleId = $this->knowledgeArticleEntity->doInsert($param);

        return $knowledgeArticleId;
    }
    /**
     * TODO: Add - End ]
     **/

    /**
     * TODO: Update - Start [
     **/

    public function update(KnowledgeArticleUpdateRequest $request): int
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

    private function _update(AdminKnowledgeArticleUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_updateKnowledgeArticle($param);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _updateKnowledgeArticle(AdminKnowledgeArticleUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $knowledgeArticleId = $this->knowledgeArticleEntity->doUpdate($param);

        return $knowledgeArticleId;
    }

    /**
     * TODO: Update - End ]
     **/

    public function getEditSelectionItems(?AdminKnowledgeArticleModel $knowledgeArticle): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        // Get Tag list
        $tagList = $this->getTagList();

        $selectionItems->addResponseItem('tagList', $tagList);

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getNewSelectionItems(): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        // Get Tag list
        $tagList = $this->getTagList();

        $selectionItems->addResponseItem('tagList', $tagList);

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getTagList(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->knowledgeArticleEntity->getTagList();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function validateUpdateParams(AdminKnowledgeArticleUpdateParam $param): bool
    {
        return true;
    }

    private function validateSaveParams(AdminKnowledgeArticleUpdateParam $updateParam, KnowledgeArticleNewRequest | KnowledgeArticleUpdateRequest $request): ?DreamerValidationErrors
    {
        //
        $errors = new DreamerValidationErrors();

        if ($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }

    public function getKnowledgeArticleListBySubjectId(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->knowledgeArticleEntity->getKnowledgeArticleListBySubjectId();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    public function getTagListByKnowledgeArticleId(int $knowledgeArticleId): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->knowledgeArticleEntity->getTagListByKnowledgeArticleId($knowledgeArticleId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }
}

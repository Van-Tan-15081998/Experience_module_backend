<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag;

use App\Constants\DetailsAction;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Tag\TagListRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Tag\TagUpdateRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Entities\DefaultTagColorEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Entities\TagEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagUpdateParam;
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

class TagBusiness extends ExperienceBaseBusiness
{
    private TagEntity $tagEntity;
    private DefaultTagColorEntity $defaultTagColorEntity;

    public function __construct()
    {
        parent::__construct();
        $this->tagEntity = App::make(TagEntity::class);
        $this->defaultTagColorEntity = App::make(DefaultTagColorEntity::class);
    }

    public function getAll() : array {
        return $this->tagEntity->getAll();
    }

    public function getPage(TagListRequest $request): AdminTagPaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount());

        $condition = $request->getSearchCondition();

        return $this->tagEntity->getPage($pageInfo, $condition);
    }

    public function getById(DetailsAction $mode, int $tagId): AdminTagModel
    {
        $detail = null;

        if (DetailsAction::VIEW()->equals($mode) || DetailsAction::CONFIRM()->equals($mode)) {
            $detail = $this->tagEntity->getById($tagId);
        } elseif (DetailsAction::EDIT()->equals($mode)) {
            $detail = $this->tagEntity->getEditTagById($tagId);

        } else {
            // Mode New
            $detail = new AdminTagModel();
            $detail->init();

            return $detail;
        }

        return $detail;
    }


    /**
     * TODO: Add - Start [
     **/
    public function add(TagUpdateRequest $request): int
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

    private function _add(AdminTagUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_insertTag($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _insertTag(AdminTagUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $tagId = $this->tagEntity->insertTag($param);

        return $tagId;
    }
    /**
     * TODO: Add - End ]
     **/

    /**
     * TODO: Update - Start [
     **/

    public function update(TagUpdateRequest $request): int
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

    private function _update(AdminTagUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_updateTag($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _updateTag(AdminTagUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $tagId = $this->tagEntity->updateTag($param);

        return $tagId;
    }

    /**
     * TODO: Update - End ]
     **/

    /**
     * TODO: Delete - Start [
     **/

    public function delete(TagUpdateRequest $request): int
    {
        // Get update params
        $updateParam = $request->getUpdateParam();

        // Validate input params
        $errors = $this->validateSaveParams($updateParam, $request);

        if (isset($errors)) {
            throw new DreamerValidationBusinessException($errors);
        }

        return $this->_delete($updateParam);
    }

    private function _delete(AdminTagUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_deleteTag($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _deleteTag(AdminTagUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $tagId = $this->tagEntity->deleteTag($param);

        return $tagId;
    }

    /**
     * TODO: Delete - End ]
     **/

    private function validateUpdateParams(AdminTagUpdateParam $param): bool
    {
        return true;
    }

    private function validateSaveParams(AdminTagUpdateParam $updateParam, TagUpdateRequest $request): ?DreamerValidationErrors
    {
        //
        $errors = new DreamerValidationErrors();

        if ($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }

    public function getEditSelectionItems(?AdminTagModel $tag): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        $defaultTagColorList = $this->getDefaultTagColor();

        $selectionItems->addResponseItem('defaultTagColorList', $defaultTagColorList);

        $isExistEmptyList |= $defaultTagColorList->empty();

        $result = new ResponseArrayModel();
        $result->addResponseItem('defaultTagColorList', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getNewSelectionItems(): ResponseArrayModel
    {
        $result = new ResponseArrayModel();

        return $result;
    }

    public function getTagList(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->tagEntity->getTagList();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    public function getDefaultTagColor(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->defaultTagColorEntity->selectDefaultTagColorList();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }
}

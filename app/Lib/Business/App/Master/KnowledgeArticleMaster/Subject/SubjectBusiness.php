<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject;

use App\Constants\DetailsAction;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Subject\SubjectListRequest;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Subject\SubjectUpdateRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Entities\SubjectEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectUpdateParam;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Common\Exception\DreamerValidationBusinessException;
use App\Lib\Business\Common\Models\DreamerValidationErrors;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Support\Facades\App;

class SubjectBusiness extends ExperienceBaseBusiness
{
    private SubjectEntity $subjectEntity;

    public function __construct()
    {
        parent::__construct();
        $this->subjectEntity = App::make(SubjectEntity::class);
    }

    public function getAll() : array {
        return $this->subjectEntity->getAll();
    }

    public function getPage(SubjectListRequest $request): AdminSubjectPaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount());

        $condition = $request->getSearchCondition();

        return $this->subjectEntity->getPage($pageInfo, $condition);
    }

    public function getById(DetailsAction $mode, int $subjectId): AdminSubjectModel
    {
        $detail = null;

        if (DetailsAction::VIEW()->equals($mode) || DetailsAction::CONFIRM()->equals($mode)) {
            $detail = $this->subjectEntity->getById($subjectId);
        } elseif (DetailsAction::EDIT()->equals($mode)) {
            $detail = $this->subjectEntity->getEditSubjectById($subjectId);

        } else {
            $detail = new AdminSubjectModel();
            $detail->init();
        }

        // Set Branch Subject List
        $branchSubjectList = $this->getBranchSubjectList($detail->getSubjectId());
        $detail->setBranchSubjectList($branchSubjectList);

        // Set Knowledge Article List
        $knowledgeArticleList = $this->getKnowledgeArticleList($detail->getSubjectId());
        $detail->setKnowledgeArticleList($knowledgeArticleList);

        return $detail;
    }


    /**
     * TODO: Add - Start [
     **/
    public function add(SubjectUpdateRequest $request): int
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

    private function _add(AdminSubjectUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_insertSubject($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _insertSubject(AdminSubjectUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $subjectId = $this->subjectEntity->insertSubject($param);

        return $subjectId;
    }
    /**
     * TODO: Add - End ]
     **/

    /**
     * TODO: Update - Start [
     **/

    public function update(SubjectUpdateRequest $request): int
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

    private function _update(AdminSubjectUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_updateSubject($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _updateSubject(AdminSubjectUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $subjectId = $this->subjectEntity->updateSubject($param);

        return $subjectId;
    }

    /**
     * TODO: Update - End ]
     **/

    private function validateUpdateParams(AdminSubjectUpdateParam $param): bool
    {
        return true;
    }

    private function validateSaveParams(AdminSubjectUpdateParam $updateParam, SubjectUpdateRequest $request): ?DreamerValidationErrors
    {
        //
        $errors = new DreamerValidationErrors();

        if ($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }

    public function getBranchSubjectList(int $subjectId): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->subjectEntity->getBranchSubjectList($subjectId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    public function getKnowledgeArticleList(int $subjectId): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->subjectEntity->getKnowledgeArticleList($subjectId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }
}

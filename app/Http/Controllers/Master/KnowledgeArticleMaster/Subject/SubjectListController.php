<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Subject;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Subject\Model\SubjectScreenRoleModel;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Subject\SubjectBaseController;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\SubjectBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use App\Lib\Common\Type\DreamerTypeObject;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use App\Lib\WebCommon\Helpers\ResponseStatus;
use App\Util\AdminExceptionUtil;
use App\Util\ResponseStatusHelper;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Base\Model\ScreenRoleModel;

class SubjectListController extends SubjectBaseController
{
    private SubjectBusiness $subjectBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->subjectBusiness = new SubjectBusiness();
    }

    /**
     * // Hàm initDisplay() chỉ get danh sách root subject (level = 1, parent_subject_code = 0)
    **/
    public function initDisplay(SubjectListRequest $request): Response
    {
        $data   = null;
        $status = null;

        $role   = $this->getMyRole();
        if (!$role->isBrowse()) {
            $status = ResponseStatusHelper::createUnauthorized(true);
        } else {
            $resultArray = $this->getInitialDisplayData($request, $role);

            $data   = $resultArray['data'];
            $status = $resultArray['status'];
        }

        return $this->responseOnSuccessfulWithCommonFields($data, $status);

    }

    protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel
    {
        // TODO: Implement createScreenRole() method.

        $screenRole = new SubjectListScreenRoleModel();

        $screenRole->setIsBrowse($role->isBrowse());

        $detailRole = $relatedScreenRoleList->getByScreenId(AdminPageType::MASTER_KNOWLEDGE_ARTICLE_SUBJECT_DETAIL()->getId());

        if(is_null($detailRole) || !$detailRole->isBrowse()) {
            $screenRole->setIsRegistration(false);
            $screenRole->setIsEdit(false);
        } else {
            $screenRole->setIsRegistration($detailRole->isRegistration());
            $screenRole->setIsEdit($detailRole->isEdit());
        }

        return $screenRole;
    }

    private function getInitialDisplayData(SubjectListRequest $request, SubjectScreenRoleModel $role): array
    {
        $data   = new ResponseArrayModel();
        $status = null;

        $isSucceeded = false;

        try {
        $page               = $this->subjectBusiness->getPage($request);
            $data->addResponseItem('page', $page);

            $isSucceeded    = true;
        } catch (DreamerBusinessException $e) {

            $code       = $e->getExceptionCode();

            $errMessage = $this->getErrorMessage($code,
                'Get Data Error');

            $status     = ResponseStatus::createErrorStatus(
                $code,
                $e->getExceptionMessage(),
                $errMessage
            );
        }

        if($isSucceeded) {
            try {
                // TODO
            } catch (DreamerBusinessException $e) {
                // TODO
            }
        }

        return [
            "data" => $data,
            "status" => $status
        ];
    }

    private function responseOnSuccessfulWithCommonFields(DreamerTypeObject $data = null,
                                                          ResponseStatus $status = null,
                                                          array $screenOptional = null): Response
    {
        return $this->apiResponseWithCommonFields(
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_SUBJECT_LIST(),
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_SUBJECT_LIST(),
            $data,
            ResponseStatusHelper::toList($status),
            $screenOptional
        );
    }

    private function getErrorMessage(string $code, string $defaultMessage = ''): string
    {
        $message = AdminExceptionUtil::getErrorMessage($code);
        if(is_null($message)) {
            $message = $defaultMessage;
        }

        return $message;
    }

    private function getMyRole(array $screenOptional = null): SubjectScreenRoleModel
    {
        return parent::getSubjectRole(AdminPageType::MASTER_KNOWLEDGE_ARTICLE_SUBJECT_LIST(), $screenOptional);
    }

    protected function getRelatedScreenIds(int $screenId): ?array
    {
        return [
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_SUBJECT_DETAIL()->getId(),
        ];
    }
}

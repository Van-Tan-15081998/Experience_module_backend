<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Tag;

use App\Constants\AdminPageType;
use App\Constants\DetailsAction;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Tag\Model\TagScreenRoleModel;
use App\Http\Controllers\Base\KnowledgeArticleMaster\Tag\TagBaseController;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\TagBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerInvalidParameterException;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;
use App\Lib\Common\Util\DreamerNumberUtil;
use App\Lib\WebCommon\Constants\MessageType;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use App\Lib\WebCommon\Helpers\ResponseHelper;
use App\Lib\WebCommon\Helpers\ResponseStatus;
use App\Util\AdminExceptionUtil;
use App\Util\ResponseStatusHelper;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagDetailController extends TagBaseController
{
    private TagBusiness $tagBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->tagBusiness = new TagBusiness();
    }

    protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel
    {
        // TODO: Implement createScreenRole() method.
        $screenRole = new AdminTagScreenRoleModel();

        $screenRole->setIsBrowse($role->isBrowse());

        // TODO: -0
        // re-check role based on action mode
        if ($role->isBrowse()) {
            $isBrowse = false;
            $isEdit = false;
            $isRegistration = false;

            if (isset($screenOptional)) {

                $mode = $screenOptional[parent::OPTIONAL_MODE];

                if (DetailsAction::VIEW()->isSame($mode)) {
                    $isBrowse = true;
                } elseif (DetailsAction::NEW()->isSame($mode)) {
                    // Đối với đăng ký mới
                    if ($role->isRegistration()) {
                        $isBrowse = true;
                        $isRegistration = true;
                        $isEdit = $role->isEdit();
                    }
                } else if (DetailsAction::EDIT()->isSame($mode)) {
                    // Để chỉnh sửa
                    if ($role->isEdit()) {
                        $isBrowse = true;
                        $isEdit = true;
                    }
                }
            }

            $screenRole->setIsBrowse($isBrowse);
            $screenRole->setIsRegistration($isRegistration);
            $screenRole->setIsEdit($isEdit);
        }

        return $screenRole;
    }

    public function initDisplay(Request $request): Response
    {
        // TODO: validateInitDisplayParams - 0

        $data   = null;
        $status = null;

        $mode   = $request->actionMode;

        $screenOptional = [
            parent::OPTIONAL_MODE => $mode
        ];

        $role = $this->getMyRole($screenOptional);
        $tagId = (int)$request->tagId;

        if(!$role->isBrowse()) {

            $status = ResponseStatusHelper::createUnauthorized(true);
        } else {

            $resultArray = $this->getInitialDisplayData($tagId, $mode, $role);

            $data = $resultArray['data'];
            $status = $resultArray['status'];
        }

        return $this->responseOnSuccessfulWithCommonFields($data, $status, $screenOptional);
    }

    public function register(TagUpdateRequest $request): Response
    {
        $mode = DetailsAction::NEW();
        $screenOptional = [
            parent::OPTIONAL_MODE => $mode->getMode()
        ];

        $role = $this->getMyRole($screenOptional);

        if(!$role->isRegistration()) {
            // Không được phép / Không có quyền
            return ResponseHelper::responseOnBusinessErrorFromStatus(
                ResponseStatusHelper::createUnauthorized()
            );
        }

        $response = null;

        $isSucceeded = false;
        $responseItems = new ResponseArrayModel();
        $messageWarning = null;

        // Quá trình thêm mới
        try {

            $tagId = $this->tagBusiness->add($request);

            $isSucceeded = true;

        } catch (DreamerBusinessException $e) {

            $response = $this->responseOnBusinessError(
                $e,
                'Đăng ký thất bại'
            );
        }

        // Nếu đăng ký thành công
        if($isSucceeded) {
            try {

                $saveData = $this->tagBusiness->getById(DetailsAction::EDIT(), $tagId);
                $responseItems->addResponseItem('data', $saveData);

                $isSucceeded = true;

            } catch (DreamerBusinessException $e) {

                $status = ResponseStatus::createErrorStatus(
                    $e->getExceptionCode(),
                    $e->getExceptionMessage(),
                    'Không lấy được dữ liệu'
                );

                $response = ResponseHelper::responseOnBusinessErrorFromStatus($status);

                $isSucceeded = false;
            }
        }

        // Nếu quá trình kết thúc bình thường, đặt response bình thường
        if($isSucceeded) {

            $statuses = ResponseStatusHelper::toList(ResponseStatusHelper::createSaveSuccessful());

            // Nếu có cảnh báo (Ví dụ: Gửi email không thành công)
            if($messageWarning !== null) {
                $statuses->add($messageWarning);
            }

            $response = $this->responseOnSuccessfulSimple($responseItems, $statuses, $screenOptional);
        }

        return $response;
    }

    public function update(TagUpdateRequest $request): Response
    {
        if(!$this->validateUpdateParams($request)) {
            throw new DreamerInvalidParameterException();
        }

        $mode = DetailsAction::EDIT();

        $screenOptional = [
            parent::OPTIONAL_MODE => $mode->getMode()
        ];

        $role = $this->getMyRole($screenOptional);

        $tagId = (int)$request->tagId;

        if(!$role->isEdit()) {
            // Không được phép / Không có quyền
            return ResponseHelper::responseOnBusinessErrorFromStatus(
                ResponseStatusHelper::createUnauthorized()
            );
        }

        $response = null;

        $isSucceeded = false;
        $responseItems = new ResponseArrayModel();
        $messageWarning = null;

        // Quá trình cập nhật
        try {

            $tagId = $this->tagBusiness->update($request);

            $isSucceeded = true;

        } catch (DreamerBusinessException $e) {

            $response = $this->responseOnBusinessError(
                $e,
                'Cập nhật thất bại'
            );
        }

        // Nếu cập nhật thành công
        if($isSucceeded) {
            try {

                $saveData = $this->tagBusiness->getById(DetailsAction::EDIT(), $tagId);
                $responseItems->addResponseItem('data', $saveData);

                $isSucceeded = true;

            } catch (DreamerBusinessException $e) {

                $status = ResponseStatus::createErrorStatus(
                    $e->getExceptionCode(),
                    $e->getExceptionMessage(),
                    'Không lấy được dữ liệu'
                );

                $response = ResponseHelper::responseOnBusinessErrorFromStatus($status);

                $isSucceeded = false;
            }
        }

        // Nếu quá trình kết thúc bình thường, đặt response bình thường
        if($isSucceeded) {

            $statuses = ResponseStatusHelper::toList(ResponseStatusHelper::createUpdateSuccessful());

            // Nếu có cảnh báo (Ví dụ: Gửi email không thành công)
            if($messageWarning !== null) {
                $statuses->add($messageWarning);
            }

            $response = $this->responseOnSuccessfulSimple($responseItems, $statuses, $screenOptional);
        }

        return $response;
    }

    public function delete(TagUpdateRequest $request): Response
    {
        if(!$this->validateUpdateParams($request)) {
            throw new DreamerInvalidParameterException();
        }

        $mode = DetailsAction::EDIT();

        $screenOptional = [
            parent::OPTIONAL_MODE => $mode->getMode()
        ];

        $role = $this->getMyRole($screenOptional);

        $tagId = (int)$request->tagId;

        if(!$role->isEdit()) {
            // Không được phép / Không có quyền
            return ResponseHelper::responseOnBusinessErrorFromStatus(
                ResponseStatusHelper::createUnauthorized()
            );
        }

        $response = null;

        $isSucceeded = false;
        $responseItems = new ResponseArrayModel();
        $messageWarning = null;

        // Quá trình cập nhật
        try {

            $tagId = $this->tagBusiness->delete($request);

            $isSucceeded = true;

        } catch (DreamerBusinessException $e) {

            $response = $this->responseOnBusinessError(
                $e,
                'Cập nhật thất bại'
            );
        }

        // Nếu quá trình kết thúc bình thường, đặt response bình thường
        if($isSucceeded) {

            $statuses = ResponseStatusHelper::toList(ResponseStatusHelper::createUpdateForDeleteSuccessful());

            // Nếu có cảnh báo (Ví dụ: Gửi email không thành công)
            if($messageWarning !== null) {
                $statuses->add($messageWarning);
            }

            $response = $this->responseOnSuccessfulSimple($responseItems, $statuses, $screenOptional);
        }

        return $response;
    }
//
//    public function reset(Request $request): ?Response
//    {
//
//    }

    private function getMyRole(array $screenOptional=null): TagScreenRoleModel
    {
        return parent::getTagRole(AdminPageType::MASTER_KNOWLEDGE_ARTICLE_TAG_DETAIL(), $screenOptional);
    }

    private function getInitialDisplayData(int $tagId, string $mode, TagScreenRoleModel $role): array
    {
        $data = new ResponseArrayModel();
        $status = null;

        // Kết quả của quá trình lấy và nhận thông tin của trang
        $isSucceeded = false;

        try {

            $adminTag = $this->tagBusiness->getById(DetailsAction::fromKey($mode), $tagId);

            $data->addResponseItem('data', $adminTag);

            $isSucceeded = true;

        } catch (DreamerBusinessException $e) {

        }

        if ($isSucceeded) {
            // Ngoài việc lấy data cho mode detail, đối với mode Add và Edit thì cần lấy data liên quan
            if(DetailsAction::EDIT()->isSame($mode) || DetailsAction::NEW()->isSame($mode))  {

                try {
                    $selectionItems = new ResponseArrayModel();

                    $selectionItems = $this->tagBusiness->getEditSelectionItems($adminTag);

                    $selectionItems = $selectionItems->toArray();

                    $data->addResponseItem('selectionItems', $selectionItems['defaultTagColorList']);
                } catch (DreamerBusinessException $e) {

                    $status = ResponseStatus::createErrorStatus(
                        $e->getExceptionCode(),
                        $e->getExceptionMessage(),
                    );
                }

            }

        }

        return [
            "data" => $data,
            "status" => $status
        ];
    }

    private function responseOnSuccessfulWithCommonFields(  DreamerTypeObject $data = null,
                                                            ResponseStatus $status = null,
                                                            array $screenOptional=null      ): Response
    {
        return $this->apiResponseWithCommonFields(
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_TAG_DETAIL(),
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_TAG_LIST(),
            $data,
            ResponseStatusHelper::toList($status),
            $screenOptional
        );
    }

    private function responseOnBusinessError(DreamerBusinessException $e, string $defaultMessage): Response
    {
        $code = $e->getExceptionCode();
        $description = $e->getExceptionMessage();
        $errMessage = $this->getErrorMessage($code, $defaultMessage);

        return ResponseHelper::responseOnBusinessError($code, $description, $errMessage);
    }

    private function getErrorMessage(string $code, string $defaultMessage): string
    {
        $message = AdminExceptionUtil::getErrorMessage($code);
        if(is_null($message)) {
            if ($code === DreamerCommonErrorCode::E00000000002()->getCode()) {

                $message = 'Không tìm thấy dữ liệu mục tiêu. Vui lòng hiển thị lại thông tin mới nhất.';

            } else {

                $message = $defaultMessage;
            }
        }

        return $message;
    }

    private function responseOnSuccessfulSimple(DreamerTypeObject $data = null,
                                                DreamerTypeList|ResponseStatus $status = null,
                                                array $screenOptional = null      ): Response
    {
        // Convert status to list
        if ($status instanceof ResponseStatus) {
            $status = ResponseStatusHelper::toList($status);
        }

        return $this->apiResponseSimple($data, $status, $screenOptional);
    }

    private function validateUpdateParams(TagUpdateRequest $request): bool
    {
        if (!DreamerNumberUtil::isInt($request->tagId)) {
            return false;
        }

//        if (!DreamerNumberUtil::isInt($request->recordVersion)) {
//            return false;
//        }

        // Có hiệu lực
        return true;
    }
}

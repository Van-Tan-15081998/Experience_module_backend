<?php

namespace App\Http\Controllers\Master\FavoriteApp\Book;

use App\Constants\AdminPageType;
use App\Http\Businesses\Common\Authentication\AdminAuthenticationBusiness;
use App\Http\Controllers\Base\FavoriteApp\Book\BookBaseController;
use App\Http\Controllers\Base\FavoriteApp\Book\Models\BookScreenRoleModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\BookBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use App\Lib\WebCommon\Helpers\ResponseStatus;
use App\Util\AdminExceptionUtil;
use App\Util\ResponseStatusHelper;
use Symfony\Component\HttpFoundation\Response;

class BookListController extends BookBaseController
{
    private BookBusiness $bookBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->bookBusiness = new BookBusiness();
    }

    public function initDisplay(BookListRequest $request): Response
    {
        $data = null;
        $status = null;

        $role = $this->getMyRole();
        if (!$role->isBrowse()) {
            $status = ResponseStatusHelper::createUnauthorized(true);
        } else {
            $resultArray = $this->getInitialDisplayData($request, $role);

            $data = $resultArray['data'];
            $status = $resultArray['status'];
        }

        return $this->responseOnSuccessfulWithCommonFields($data, $status);

    }

    protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel
    {
        // TODO: Implement createScreenRole() method.

        $screenRole = new BookListScreenRoleModel();

        $screenRole->setIsBrowse($role->isBrowse());

        $detailRole = $relatedScreenRoleList->getByScreenId(AdminPageType::MASTER_FAVORITE_APP_BOOK_DETAIL()->getId());

        if(is_null($detailRole) || !$detailRole->isBrowse()) {
            $screenRole->setIsRegistration(false);
            $screenRole->setIsEdit(false);
        } else {
            $screenRole->setIsRegistration($detailRole->isRegistration());
            $screenRole->setIsEdit($detailRole->isEdit());
        }

        return $screenRole;
    }

    private function getInitialDisplayData(BookListRequest $request, BookScreenRoleModel $role): array
    {
        $data = new ResponseArrayModel();
        $status = null;

        $isSucceeded = false;

        try {
            $page = $this->bookBusiness->getPage($request);
            $data->addResponseItem('page', $page);

            $isSucceeded = true;
        } catch (DreamerBusinessException $e) {

            $code = $e->getExceptionCode();

            $errMessage = $this->getErrorMessage($code,
                'Get Data Error');

            $status = ResponseStatus::createErrorStatus(
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

    private function responseOnSuccessfulWithCommonFields(Object $data = null,
                                                          ResponseStatus $status = null,
                                                          array $screenOptional = null): Response
    {
        return $this->apiResponseWithCommonFields(
            AdminPageType::MASTER_FAVORITE_APP_BOOK_LIST(),
            AdminPageType::MASTER_FAVORITE_APP_BOOK_LIST(),
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

    private function getMyRole(array $screenOptional = null): BookScreenRoleModel
    {
        return parent::getBookRole(AdminPageType::MASTER_FAVORITE_APP_BOOK_LIST(), $screenOptional);
    }

    protected function getRelatedScreenIds(int $screenId): ?array
    {
        return [
            AdminPageType::MASTER_FAVORITE_APP_BOOK_DETAIL()->getId(),
        ];
    }
}

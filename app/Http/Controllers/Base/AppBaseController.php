<?php

namespace App\Http\Controllers\Base;

use App\Constants\AdminPageType;
use App\Constants\DetailsAction;
use App\Http\Businesses\Common\Authentication\AdminAuthenticationBusiness;
use App\Http\Controllers\Base\Model\BreadcrumbModel;
use App\Http\Controllers\Base\Model\ContentsModel;
use App\Http\Controllers\Base\Model\FooterModel;
use App\Http\Controllers\Base\Model\HeaderMenuModel;
use App\Http\Controllers\Base\Model\HeaderModel;
use App\Http\Controllers\Base\Model\HtmlHeadModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Http\Controllers\Controller;
use App\Lib\Business\App\Admin\Common\AdminCommonBusiness;
use App\Lib\Business\App\Admin\Common\Models\AdminCommonDisplayModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;
use App\Lib\WebCommon\Helpers\ResponseHelper;
use Symfony\Component\HttpFoundation\Response;

abstract class AppBaseController extends Controller
{
    public function __construct()
    {
        $this->init();
    }

    protected function init(): void
    {

    }

    abstract protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel;

    protected function getRole(AdminPageType $pageType, array $screenOptional = null): ScreenRoleModel
    {
        $loggedInUser = AdminAuthenticationBusiness::getLoggedInUser();

        $accountId = $loggedInUser->getAccountId();
        $screenId = $pageType->getId();

        $relatedScreenIds = $this->getRelatedScreenIds($screenId);

        $adminBiz = new AdminCommonBusiness();
        $roleList = $adminBiz->getRoles($accountId, $screenId, $relatedScreenIds);

        $role = $roleList->getByScreenId($screenId);
        if(is_null($role)) {
            $noRole = $this->createScreenRoleInstance();
            $noRole->noRole();
            return $noRole;
        }

        return $this->createScreenRole($screenId, $screenOptional, $role, $roleList);
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new ScreenRoleModel();
    }

    protected function getRelatedScreenIds(int $screenId): ?array
    {
        return null;
    }

    protected function apiResponseWithCommonFields( AdminPageType $pageType,
                                                    AdminPageType $breadcrumbPageType,
                                                    DreamerTypeObject $data = null,
                                                    DreamerTypeList $statuses = null,
                                                    array $screenOptional = null): Response
    {

        $loggedInUser = AdminAuthenticationBusiness::getLoggedInUser();
        $accountId = $loggedInUser->getAccountId();

        $screenId = $pageType->getId();
        $breadcrumbPageId = $breadcrumbPageType->getId();

        try {
            $adminBiz = new AdminCommonBusiness();
            $commonDisplayInfo = $adminBiz->getCommonDisplayInfo(
                $accountId,
                $screenId,
                $breadcrumbPageId,
                $this->getRelatedScreenIds($screenId)
            );

            $header = $this->createHeader($screenId, $commonDisplayInfo);
            $footer = $this->createFooter();

            $contents = $this->createContents($screenId,
                $breadcrumbPageId,
                $commonDisplayInfo,
                $screenOptional
            );

            $htmlHead = $this->createHtmlHead($commonDisplayInfo);

        } catch(\Exception $e) {
            // TODO
        }

        $responseData = [];
        if (isset($data)) {
            $responseData = $data->toArray();
        }

        $responseStatuses = [];
        if(isset($statuses)) {
            $responseStatuses = $statuses->toArray();
        }

        return ResponseHelper::responseOnSuccessful(
            $htmlHead->toArray(),
            $header->toArray(),
            $footer->toArray(),
            $contents->toArray(),
            $responseData,
            $responseStatuses
        );
    }

    protected function apiResponseWithDialogCommonFields(   AdminPageType $pageType,
                                                            Object $data = null,
                                                            array $statuses = null,
                                                            array $screenOptional=null ): Response
    {
        return ResponseHelper::responseOnSuccessful(
            null,
            null,
            null,
            null,
            null,
            null
        );
    }

    protected function apiResponseSimple(   Object $data = null,
                                            array $statuses = null   ): Response
    {
        $responseData = [];
        if (isset($data)) {
            $responseData = $data->toArray();
        }

        $responseStatuses = [];
        if(isset($statuses)) {
            $responseStatuses = $statuses;
        }

        return ResponseHelper::responseOnSuccessful(
            null,
            null,
            null,
            null,
            $responseData,
            $responseStatuses
        );
    }

    protected function getDetailActionTitle(string $mode): ?string
    {
        $title = null;

        if(DetailsAction::VIEW()->isSame($mode)) {
            $title = 'title_detail_view';
        } elseif(DetailsAction::NEW()->isSame($mode)) {
            $title = 'title_detail_new';
        } elseif(DetailsAction::EDIT()->isSame($mode)) {
            $title = 'title_detail_edit';
        } elseif(DetailsAction::CONFIRM()->isSame($mode)) {
            $title = 'title_detail_confirm';
        }

        return $title;
    }

    protected final function getMessage(string $msgId): string
    {
        return __($msgId);
    }

    private function createHtmlHead(AdminCommonDisplayModel $displayInfo): HtmlHeadModel
    {
        $head = new HtmlHeadModel();

        $screenInfo = $displayInfo->getScreenInfo();
        $head->setTitle($screenInfo->getFunctionTitle());

        return $head;
    }

    private function createHeader(int $screenId, AdminCommonDisplayModel $displayInfo): HeaderModel
    {
        $header = new HeaderModel();

        $menu = new HeaderMenuModel();
        $menu->setGroupList($displayInfo->getMenuGroupList());
        $menu->setActiveGroupIdByScreenId($screenId);

        $header->setMenu($menu);

        return $header;
    }

    private function createFooter(): FooterModel
    {
        $footer = new FooterModel();

        return $footer;
    }

    private function createContents(int $screenId,
                                    ?int $breadcrumbScreenId,
                                    AdminCommonDisplayModel $commonDisplayInfo,
                                    ?array $screenOptional): ContentsModel
    {
        $contents = new ContentsModel();

        $screenInfo = $commonDisplayInfo->getScreenInfo();
        $screenTitle = $this->adjustScreenTitle($screenId,
            $screenOptional,
            $screenInfo->getScreenTitle()
        );

        if(isset($breadcrumbScreenId)) {
            $breadcrumbs = $this->createBreadcrumb(
                $screenId,
                $breadcrumbScreenId,
                $commonDisplayInfo,
                $screenTitle
            );
            $contents->setBreadcrumbs($breadcrumbs);
        }

        $role = $commonDisplayInfo->getScreenInfo()->getRole();
        if ($role) {
            $screenRole = $this->createScreenRole(  $screenId,
                $screenOptional,
                $role,
                $commonDisplayInfo->getRelatedScreenRoleList()
            );
            $contents->setRole($screenRole);
        }

        $contents->setPageTitle($screenTitle);

        return $contents;
    }

    private function createBreadcrumb(  int $screenId,
                                        int $breadcrumbScreenId,
                                        AdminCommonDisplayModel $commonDisplayInfo,
                                        string $screenTitle                         ): ?DreamerTypeList
    {
        $breadcrumbs = [];

//        if($screenId === AdminPageType::TOP()->getId()) {
//            return $this->createBreadcrumbForTop();
//
//        } elseif($screenId === AdminPageType::PERSONAL_CHANGE_PASSWORD()->getId()) {
//            return $this->createBreadcrumbForChangePassword();
//        }


        $menuGroup = $commonDisplayInfo->getScreenInfo()->getMenuGroup();

        if (is_null($menuGroup)) {
//            return $breadcrumbs;
            $result = new DreamerTypeList([]);
            $result->addList($breadcrumbs);

            return new $result;
        }

        $breadcrumb = new BreadcrumbModel();
        $breadcrumb->setLabel($menuGroup->getName());

        $breadcrumbs[] = $breadcrumb;

        $menuCategory = null;
        if (!is_null($menuGroup)) {
            $menuCategory = $menuGroup->getCategoryByScreenId($breadcrumbScreenId);

            if (!is_null($menuCategory)) {
                $breadcrumb = new BreadcrumbModel();
                $breadcrumb->setLabel($menuCategory->getName());

                $breadcrumbs[] = $breadcrumb;
            }
        }

        $menuLabel = null;
        if (!is_null($menuCategory)) {
            $menu = $menuCategory->getMenuByScreenId($breadcrumbScreenId);

            if (!is_null($menu)) {
                $menuLabel = $menu->getName();

                $breadcrumb = new BreadcrumbModel();
                $breadcrumb->setLabel($menuLabel);
                $breadcrumb->setIsTitle(true);

                $breadcrumbs[] = $breadcrumb;
            }
        }

        if ($menuLabel === $screenTitle) {

        } else {

            $breadcrumb = new BreadcrumbModel();
            $breadcrumb->setLabel($screenTitle);
            $breadcrumb->setIsTitle(false);

            $breadcrumbs[] = $breadcrumb;
        }

        $result = new DreamerTypeList([]);
        $result->addList($breadcrumbs);

        return new $result;
    }

    private function createBreadcrumbForTop(): DreamerTypeList
    {
        $breadcrumb = new BreadcrumbModel();
        $breadcrumb->setLabel('top_title');
        $breadcrumb->setIsTitle(true);

        $breadcrumbs[] = $breadcrumb;

        $result = new DreamerTypeList([]);
        $result->addList($breadcrumbs);

        return new $result;
    }

    private function createBreadcrumbForChangePassword(): DreamerTypeList
    {
        $breadcrumb = new BreadcrumbModel();

        $breadcrumbs[] = $breadcrumb;

        $breadcrumbs[] = $breadcrumb;

        $result = new DreamerTypeList([]);
        $result->addList($breadcrumbs);

        return new $result;
    }

    protected function adjustScreenTitle(int $screenId,
                                         ?array $screenOptional,
                                         string $title           ): string
    {
        $mode = null;
        if(isset($screenOptional)) {
            $mode = $screenOptional['mode'];
        }

        if(isset($mode)) {
            $title = $this->adjustDetailScreenTitle($screenId, $mode, $title);
        }

        return $title;
    }

    protected function adjustDetailScreenTitle( int $screenId,
                                                string $mode,
                                                string $title   ): string
    {
        $actionTitle = $this->getDetailActionTitle($mode);

        if($actionTitle !== null) {
            if($this->isReplaceScreenTitle()) {
                $title = $actionTitle;
            } else {
                $title = $title . ' ' . $actionTitle;
            }
        }

        return $title;
    }

    protected function isReplaceScreenTitle(): bool
    {
        return true;
    }
}

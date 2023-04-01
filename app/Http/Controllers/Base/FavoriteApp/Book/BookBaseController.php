<?php

namespace App\Http\Controllers\Base\FavoriteApp\Book;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\AppBaseController;
use App\Http\Controllers\Base\FavoriteApp\Book\Models\BookScreenRoleModel;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\BookBusiness;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;
use Illuminate\Support\Facades\App;

abstract class BookBaseController extends AppBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getBookRole(AdminPageType $pageType, array $screenOptional=null): BookScreenRoleModel
    {
        return BookScreenRoleModel::cast(parent::getRole($pageType, $screenOptional));
    }

    protected function createScreenRoleInstance(): ?ScreenRoleModel
    {
        return new BookScreenRoleModel();
    }
}

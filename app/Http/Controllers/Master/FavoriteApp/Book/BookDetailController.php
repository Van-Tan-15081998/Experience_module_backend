<?php

namespace App\Http\Controllers\Master\FavoriteApp\Book;

use App\Http\Controllers\Base\FavoriteApp\Book\BookBaseController;
use App\Http\Controllers\Base\Model\ScreenRoleModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\BookBusiness;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionListModel;
use App\Lib\Business\Specific\Staff\AccountRole\Models\RoleFunctionModel;

class BookDetailController extends BookBaseController
{
    private BookBusiness $bookBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->bookBusiness = new BookBusiness();
    }

    protected function createScreenRole(int $screenId, ?array $screenOptional, RoleFunctionModel $role, RoleFunctionListModel $relatedScreenRoleList): ?ScreenRoleModel
    {
        // TODO: Implement createScreenRole() method.
    }
}

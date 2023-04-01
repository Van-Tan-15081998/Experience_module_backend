<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book;

use App\Http\Controllers\Master\FavoriteApp\Book\BookListRequest;
use App\Lib\Business\App\Master\FavoriteApp\Book\Entities\BookEntity;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookPaginationModel;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Common\Core\DataSource\Models\PageInfo;

class BookBusiness extends ExperienceBaseBusiness
{
    private BookEntity $bookEntity;

    public function __construct()
    {
        parent::__construct();
        $this->bookEntity = new BookEntity();
    }

    public function getAll() : array {
        return $this->bookEntity->getAll();
    }

    public function getPage(BookListRequest $request): AdminBookPaginationModel
    {
//         $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount()); // TODO-CLOSE-FOR-TEST-01
        $pageInfo = new PageInfo(2, 2); // TODO-TEST-01
        $condition = $request->getSearchCondition();

        $page = $this->bookEntity->getPage($pageInfo, $condition);

        return $page;
    }
}

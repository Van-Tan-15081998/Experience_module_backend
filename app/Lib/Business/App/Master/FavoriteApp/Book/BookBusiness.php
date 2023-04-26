<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book;

use App\Constants\DetailsAction;
use App\Http\Controllers\Master\FavoriteApp\Book\BookListRequest;
use App\Http\Controllers\Master\FavoriteApp\Book\BookUpdateRequest;
use App\Lib\Business\App\Master\FavoriteApp\Book\Entities\BookEntity;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookPaginationModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookUpdateParam;
use App\Lib\Business\App\Master\FavoriteApp\Common\Book\BookCommonBusiness;
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

class BookBusiness extends ExperienceBaseBusiness
{
    private BookEntity $bookEntity;

    private BookCommonBusiness $bookCommonBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->bookEntity = App::make(BookEntity::class);
        $this->bookCommonBusiness = App::make(BookCommonBusiness::class);
    }

    public function getAll() : array {
        return $this->bookEntity->getAll();
    }

    public function getPage(BookListRequest $request): AdminBookPaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount()); // TODO-CLOSE-FOR-TEST-01
//        $pageInfo = new PageInfo(4, 3); // TODO-TEST-01

        $condition = $request->getSearchCondition();

        $page = $this->bookEntity->getPage($pageInfo, $condition);

        return $page;
    }

    public function getById(DetailsAction $mode, int $bookId): AdminBookModel
    {
        $detail = null;

        if (DetailsAction::VIEW()->equals($mode) || DetailsAction::CONFIRM()->equals($mode)) {
            $detail = $this->bookEntity->getById($bookId);
        } elseif (DetailsAction::EDIT()->equals($mode)) {
            $detail = $this->bookEntity->getEditBookById($bookId);

        } else {
            $detail = new AdminBookModel();
            $detail->init();
        }

        // Set language list
        $languageList = $this->bookCommonBusiness->getLanguageList($bookId);
        $detail->setLanguageList($languageList);

        // Set publisher list
        $publisherList = $this->bookCommonBusiness->getPublisherListByBookId($bookId);
        $detail->setPublisherList($publisherList);

        return $detail;
    }

    public function getEditSelectionItems(?AdminBookModel $book): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        $publisherList = $this->getPublisherList();

        $selectionItems->addResponseItem('publisherList', $publisherList);
        $isExistEmptyList |= $publisherList->empty();

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getPublisherList(): DreamerTypeList
    {
        return $this->bookCommonBusiness->getPublisherList();
    }

    /**
     * TODO: Add - Start [
    **/
    public function add(BookUpdateRequest $request): int
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

    private function _add(AdminBookUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_insertBook($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _insertBook(AdminBookUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $bookId = $this->bookEntity->insertBook($param);

        return $bookId;
    }
    /**
     * TODO: Add - End ]
     **/

    /**
     * TODO: Update - Start [
     **/

    public function update(BookUpdateRequest $request): int
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

    private function _update(AdminBookUpdateParam $param): int
    {
        $result = null;

        // Khối try catch để catch các lỗi trong quá trình thao tác với Database
        try {
            $result = $this->_updateBook($param);

        } catch (\Exception $e) {

            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }

    private function _updateBook(AdminBookUpdateParam $param): int {

        $isValid = $this->validateUpdateParams($param);

        // Nếu xảy ra lỗi [[['Dữ liệu không thống nhất' - DreamerCommonErrorCode::E00000000004()]]]
        if (!$isValid) {
            throw new DreamerBusinessException(
                DreamerCommonErrorCode::E00000000004()->getCode(),
                DreamerCommonErrorCode::E00000000004()->getDescription()
            );
        }

        $bookId = $this->bookEntity->updateBook($param);

        return $bookId;
    }

    /**
     * TODO: Update - End ]
     **/

    private function validateUpdateParams(AdminBookUpdateParam $param): bool
    {
        // Đối với các tham số dưới dạng là ID của một Entity, sẽ dùng Business quản lý
            // entity đó để kiểm tra xem entity có ID có tồn tại hay hợp lệ hay không?
            // (Ví dụ: Dữ liệu Entity có ID đó đã bị xóa logic - is deleted; hay bị close,...

        if (is_null($param->getBookId())) {
            // If bookId is null, this is ADD NEW mode
            foreach (($param->getPublisherList()->getList()) as $publisherId) {
                if(!$this->bookCommonBusiness->isValidPublisher($publisherId['publisherId'])) {
                    return false;
                }
            }
        }


        return true;
    }

    private function validateSaveParams(AdminBookUpdateParam $updateParam, BookUpdateRequest $request): ?DreamerValidationErrors
    {
        //
        $errors = new DreamerValidationErrors();

        if ($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Book\Entities;

use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookCondition;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookPaginationModel;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookUpdateParam;
use App\Lib\Business\App\Master\FavoriteApp\Book\Models\BookModel;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class BookEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'book_id ',
        'title',
        'author_code',
        'publisher_code',
        'category_code',
        'edition',
        'content',
        'total_pages',
        'format_code',
        'summary',
        'availability',
        'quantity',
        'price',
        'weight',
        'cover_picture',
        'rating',
        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];

    protected $table = 'favorite_app__books';
    protected $primaryKey = 'book_id';

    public function getPage(PageInfo $pageInfo, AdminBookCondition $condition)
    {
        $page = null;

        try {
            $page = $this->paginateByCondition($pageInfo, $condition);

        } catch (Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $page;
    }

    public function paginateByCondition(PageInfo $pageInfo, AdminBookCondition $condition = null): AdminBookPaginationModel
    {
        $result = [];

//        $bookList = DB::table($this->table)
//            ->select(
//                '*'
//            )->get()->toArray();
//
//        if (empty($bookList)) {
//            return $result;
//        }
//
//        foreach ($bookList as $key => $value) {
//            $result[$key] = BookModel::createFromRecord($value);
//
//            // convert to array
//            $result[$key] = $result[$key]->toArray();
//        }

        $query =
            "SELECT *"
            . " FROM favorite_app__books"
            . " WHERE favorite_app__books.is_deleted = 0 ";

        if (!is_null($condition)) {
            $query .= '';
            // TODO
        }

        $result = $this->paginate($query, $pageInfo, new AdminBookPaginationModel());

        return $result;
    }

    protected function paginate(string $query,
                                PageInfo $pageInfo,
                                PaginationModel $paginationModelClass,
                                string $paginateFunctionName = null
    ): PaginationModel
    {
        $start = $pageInfo->getStartPage();

        if ($start < 1) {
            $start = 1;
        }

        $limit = $pageInfo->getLimitCount();

        $originalQuery = $query;

        $query .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

        $data = DB::select($query);

        $cnt = 0;

        if(count($data) > 0) {
//            $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . preg_replace('/;/i', '', $query, 1) . ') AS subquery;';
            $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
            $countResultExecute = DB::select($countResultQuery);

            $cnt = $countResultExecute[0]->paginate_total_count;
        } else {
            if($start > 1) {

                $start = 1;

                $originalQuery .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

                $data = DB::select($originalQuery);

                if(count($data) > 0) {
                    $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
                    $countResultExecute = DB::select($countResultQuery);

                    $cnt = $countResultExecute[0]->paginate_total_count;
                }
            }
        }

        $lastPage = (int) ceil($cnt / $limit);

        $paginationInfo = new PaginationInfo();
        $paginationInfo->setCurrentPage($start);
        $paginationInfo->setTotalPages($lastPage);
        $paginationInfo->setLimitCount($limit);
        $paginationInfo->setTotalCount($cnt);

        $modelClass = get_Class($paginationModelClass);
        $return = new $modelClass();
        $return->setPaginationInfo($paginationInfo);

        if(!isset($paginateFunctionName)) {
            $paginateFunctionName = 'convertResult';
        }

        $return->$paginateFunctionName($data);

        return $return;
    }

    public function getById(int $bookId): AdminBookModel
    {
        $detail = null;

        try {
            $detail = $this->selectById($bookId);


        } catch (Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function getEditBookById(int $bookId): AdminBookModel
    {
        $detail = null;

        try {
            $detail = $this->selectEditBoothById($bookId);


        } catch (Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

//    public function getById(int $bookId) : array {
//        $result = DB::table($this->table)
//            ->where('book_id', $bookId)
//            ->select('*'
//            )->get()->toArray();
//
//        if (empty($result)) {
//            return [];
//        }
//
//        $result = BookModel::createFromRecord($result[0]);
//
//        return $result->toArray();
//    }
//
//    public function getAll() : array {
//        $result = [];
//        $bookList = DB::table($this->table)
//            ->select(
//                '*'
//            )->get()->toArray();
//
//        if (empty($bookList)) {
//            return [];
//        }
//
//        foreach ($bookList as $key => $value) {
//            $result[$key] = BookModel::createFromRecord($value);
//
//            // convert to array
//            $result[$key] = $result[$key]->toArray();
//        }
//
//        return $result;
//    }

    public function selectById(int $boothId): ?AdminBookModel
    {
        $query =
            "SELECT *"
            . " FROM favorite_app__books"
            . " WHERE favorite_app__books.book_id = " . $boothId
            . " AND favorite_app__books.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminBook =  AdminBookModel::createFromRecord($result[0]);

        return $adminBook;
    }

    public function selectEditBoothById(int $boothId): ?AdminBookModel
    {
        $query =
            "SELECT *"
            . " FROM favorite_app__books"
            . " WHERE favorite_app__books.book_id = " . $boothId
            . " AND favorite_app__books.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminBook =  AdminBookModel::createFromRecordForEdit($result[0]);

        return $adminBook;
    }

    public function insert(AdminBookUpdateParam $param): int {

        $bookId = DB::table('favorite_app__books')->insertGetId(
            ['title' => $param->getTitle()]
        );

        $this->insertPublisher($bookId, $param->getPublisherList());

        return $bookId;
    }

    private function insertPublisher(int $bookId, DreamerTypeList $publisherList) {
        /**
         * $publisherList là tham số dạng mảng:
         * [
         *  { publisherId : 1 },
         *  { publisherId : 2 },
         *  { publisherId : 3 },
         * ]
        **/

        foreach ($publisherList->getList() as $publisherId) {
            DB::table('favorite_app__book_publisher_allocations')->insert([
                ['book_id' => $bookId, 'publisher_id' => $publisherId['publisherId']],
            ]);
        }
    }
}

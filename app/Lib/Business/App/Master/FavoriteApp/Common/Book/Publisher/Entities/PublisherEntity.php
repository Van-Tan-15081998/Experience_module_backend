<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher\Entities;

use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Publisher\Models\PublisherModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PublisherEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'publisher_id ',
        'name',
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

    protected $table = 'favorite_app__publishers';
    protected $primaryKey = 'publisher_id';

    public function getPublisherList(): DreamerTypeList
    {
        return $this->selectPublisherList();
    }

    private function selectPublisherList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM favorite_app__publishers"
            . " WHERE favorite_app__publishers.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $publisherList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $publisher = PublisherModel::createFromRecord($record);
            $publisherList->add($publisher);
        }

        return $publisherList;
    }

    public function isValid(int $publisherId): ?bool
    {
        $isValid = false;

        $query =
            'SELECT' .
            ' publisher_id' .
            ' FROM' .
            ' favorite_app__publishers' .
            ' WHERE' .
            ' favorite_app__publishers.is_deleted = 0' .
            ' AND favorite_app__publishers.publisher_id = ' . $publisherId
        ;

        // Execute query
        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        } else if($result[0]->publisher_id) {
            $isValid = true;
        }

        return $isValid;
    }

    public function getPublisherListByBookId($bookId): DreamerTypeList
    {
//        $query =
//            "SELECT *"
//            . " FROM favorite_app__book_publisher_allocations"
//            . " WHERE favorite_app__book_publisher_allocations.is_deleted = 0 "
//                . " AND favorite_app__book_publisher_allocations.book_id = " . $bookId;

        $query =
            "SELECT *"
            .   " FROM favorite_app__publishers"
            .   " JOIN favorite_app__book_publisher_allocations"
                .   " ON favorite_app__publishers.publisher_id = favorite_app__book_publisher_allocations.publisher_id"
                .   " AND favorite_app__book_publisher_allocations.is_deleted = 0"
            .   " WHERE favorite_app__publishers.is_deleted = 0"
            .   " AND favorite_app__book_publisher_allocations.book_id = " . $bookId;


        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $publisherList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $publisher = PublisherModel::createFromRecord($record);
            $publisherList->add($publisher);
        }

        return $publisherList;
    }
}

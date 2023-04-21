<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language\Entities;

use App\Lib\Business\App\Master\FavoriteApp\Common\Book\Language\Models\LanguageModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LanguageEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'language_id ',
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

    protected $table = 'favorite_app__languages';
    protected $primaryKey = 'language_id';

    public function getLanguageList(int $bookId): DreamerTypeList
    {
        return $this->selectLanguageList($bookId);
    }

    private function selectLanguageList(int $bookId): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM favorite_app__languages"

            . " JOIN favorite_app__book_language_allocations"
                . " ON favorite_app__book_language_allocations.language_id = favorite_app__languages.language_id"
                . " AND favorite_app__book_language_allocations.book_id = " . $bookId
                . " AND favorite_app__book_language_allocations.is_deleted = 0"

            . " WHERE favorite_app__languages.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $publisherList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $publisher = LanguageModel::createFromRecord($record);
            $publisherList->add($publisher);
        }

        return $publisherList;
    }

    public function isValid(int $languageId): ?bool
    {
        $isValid = false;

        $query =
            'SELECT' .
            ' language_id' .
            ' FROM' .
            ' favorite_app__languages' .
            ' WHERE' .
            ' favorite_app__languages.is_deleted = 0' .
            ' AND favorite_app__languages.language_id = ' .  $languageId
        ;

        // Execute query
        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        } else if($result[0]->language_id) {
            $isValid = true;
        }

        return $isValid;
    }
}

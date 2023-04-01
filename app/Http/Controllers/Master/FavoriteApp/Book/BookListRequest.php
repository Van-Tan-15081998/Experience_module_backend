<?php

namespace App\Http\Controllers\Master\FavoriteApp\Book;

use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookCondition;
use Illuminate\Foundation\Http\FormRequest;

class BookListRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function getPageNo(): int
    {
        if ($this->has('pageNo')) {
            return (int) $this->pageNo;
        } else {
            return 1;
        }
    }

    public function getLimitCount(): int
    {
        if ($this->has('limitCount')) {
            return (int) $this->limitCount;
        } else {
            return 10;
        }
    }

    public function getSearchCondition(): AdminBookCondition
    {
        $condition = new AdminBookCondition();

        if($this->has('searchCondition')) {
            // TODO
        }

        return $condition;
    }

    public function getExportCondition() {

    }
}

<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchCondition;
use Illuminate\Foundation\Http\FormRequest;

class MasterSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'searchString' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'searchString.required'            => 'Từ khóa là bắt buộc',
        ];
    }

    public function getSearchParam(): AdminMasterSearchCondition
    {
        $searchParam = new AdminMasterSearchCondition();

        $searchParam->setSearchString($this->searchString);

        return $searchParam;
    }

    public function getPageNo(): int
    {
//        if ($this->has('pageNo')) {
//            return (int) $this->pageNo;
//        } else {
//            return 1;
//        }
        if ($this->has('currentPage')) {
            return (int) $this->currentPage;
        } else {
            return 1;
        }
    }

    public function getLimitCount(): int
    {
        if ($this->has('limitCount') && ($this->limitCount == 5 || $this->limitCount == 10 || $this->limitCount == 25 || $this->limitCount == 50 || $this->limitCount == 100)) {
            return (int) $this->limitCount;
        } else {
            return 10;
        }
    }

    public function getSearchCondition(): AdminMasterSearchCondition
    {
        $condition = new AdminMasterSearchCondition();

        if($this->has('searchCondition')) {
            // TODO
        }

        return $condition;
    }
}

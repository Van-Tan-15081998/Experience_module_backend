<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Subject;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectCondition;
use Illuminate\Foundation\Http\FormRequest;

class SubjectListRequest extends FormRequest
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

    public function getSearchCondition(): AdminSubjectCondition
    {
        $condition = new AdminSubjectCondition();

        if($this->has('searchCondition')) {
            // TODO
        }

        return $condition;
    }

    public function getExportCondition() {

    }
}

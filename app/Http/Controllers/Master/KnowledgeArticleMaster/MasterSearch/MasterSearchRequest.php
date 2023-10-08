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
        $rules = [
            'searchString' => 'required|max:255',
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'searchString.required'            => 'Từ khóa là bắt buộc',
        ];

        return $messages;
    }

    public function getSearchParam(): AdminMasterSearchCondition
    {
        $searchParam = new AdminMasterSearchCondition();

        $searchParam->setSearchString($this->searchString);

        return $searchParam;
    }
}

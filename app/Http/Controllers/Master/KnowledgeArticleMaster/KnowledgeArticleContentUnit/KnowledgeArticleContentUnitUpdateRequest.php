<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeArticleContentUnitUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'            => 'Tiêu đề Unit là bắt buộc',
        ];

        return $messages;
    }

    public function getUpdateParam(): AdminKnowledgeArticleContentUnitUpdateParam
    {
        $updateParam = new AdminKnowledgeArticleContentUnitUpdateParam();

        $updateParam->setTitle($this->title);

        return $updateParam;
    }
}

<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeArticleContentUnitNewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'knowledgeArticleId' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'            => 'Tiêu đề Unit là bắt buộc',
            'knowledgeArticleId.required' => 'Vui lòng thêm Unit từ bài viết của bạn'
        ];

        return $messages;
    }

    public function getUpdateParam(): AdminKnowledgeArticleContentUnitUpdateParam
    {
        $updateParam = new AdminKnowledgeArticleContentUnitUpdateParam();

        $updateParam->setKnowledgeArticleId($this->knowledgeArticleId);
        $updateParam->setTitle($this->title);

        return $updateParam;
    }
}

<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeArticleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|max:255'
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'            => 'Tiêu đề bài viết là bắt buộc',
        ];

        return $messages;
    }

    public function getUpdateParam(): AdminKnowledgeArticleUpdateParam
    {
        $updateParam = new AdminKnowledgeArticleUpdateParam();

        $updateParam->setKnowledgeArticleId($this->knowledgeArticleId);
        $updateParam->setTitle($this->title);
        $updateParam->setKnowledgeArticleTagList(new DreamerTypeList($this->tagList));

        return $updateParam;
    }
}

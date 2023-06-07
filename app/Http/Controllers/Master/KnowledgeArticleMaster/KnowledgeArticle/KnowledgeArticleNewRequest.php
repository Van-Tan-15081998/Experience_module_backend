<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleUpdateParam;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeArticleNewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'subjectId' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'            => 'Tiêu đề bài viết là bắt buộc',
            'subjectId.required' => 'Vui lòng thêm bài viết từ chủ đề của bạn'
        ];

        return $messages;
    }

    public function getUpdateParam(): AdminKnowledgeArticleUpdateParam
    {
        $updateParam = new AdminKnowledgeArticleUpdateParam();

        $updateParam->setKnowledgeArticleId($this->knowledgeArticleId);
        $updateParam->setTitle($this->title);

        // Mode new cần subjectId
        $updateParam->setSubjectId((int) $this->subjectId);


        return $updateParam;
    }
}

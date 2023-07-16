<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitNewParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
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
            'unitContent' => 'required',
            'knowledgeArticleId' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'title.required'            => 'Tiêu đề của Unit là bắt buộc',
            'unitContent.required'            => 'Nội dung của Unit là bắt buộc',
            'knowledgeArticleId.required' => 'Vui lòng thêm Unit từ bài viết của bạn'
        ];

        return $messages;
    }

    public function getNewParam(): AdminKnowledgeArticleContentUnitNewParam
    {
        $newParam = new AdminKnowledgeArticleContentUnitNewParam();

        $newParam->setKnowledgeArticleId($this->knowledgeArticleId);
        $newParam->setTitle($this->title);
        $newParam->setUnitContent($this->unitContent);
        $newParam->setImageList(new DreamerTypeList($this->imageList));

        return $newParam;
    }
}

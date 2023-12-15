<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Tag;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagUpdateParam;
use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'Tiêu đề chủ đề là bắt buộc',
            'title.max'                 => 'Tiêu đề chủ đề không được dài quá 255 ký tự',
        ];
    }

    public function getUpdateParam(): AdminTagUpdateParam
    {
        $updateParam = new AdminTagUpdateParam();

        $updateParam->setTagId($this->tagId);
        $updateParam->setTitle($this->title);
        $updateParam->setLevel($this->level);
        $updateParam->setSequence($this->sequence);

        $updateParam->setColor($this->color ?? null);

        return $updateParam;
    }
}

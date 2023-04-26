<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Subject;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectUpdateParam;
use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
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
            'title.required'            => 'Tiêu đề sách là bắt buộc',
            'title.max'                 => 'Tiêu đề sách không được dài quá 255 ký tự',
        ];
    }

    public function getUpdateParam(): AdminSubjectUpdateParam
    {
        $updateParam = new AdminSubjectUpdateParam();

        $updateParam->setSubjectId($this->subjectId);
        $updateParam->setTitle($this->title);
        $updateParam->setLevel($this->level);
        $updateParam->setSequence($this->sequence);
        $updateParam->setParentSubjectCode($this->parentSubjectCode);
        $updateParam->setRootSubjectCode($this->rootSubjectCode);

        return $updateParam;
    }
}

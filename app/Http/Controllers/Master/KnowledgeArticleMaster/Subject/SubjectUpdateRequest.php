<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\Subject;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
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

            'parentSubjectList' => 'array',
            'parentSubjectList.*.subjectId' => 'numeric|min:0|not_in:0',

            'branchSubjectList' => 'array',
            'branchSubjectList.*.subjectId' => 'numeric|min:0|not_in:0',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'Tiêu đề chủ đề là bắt buộc',
            'title.max'                 => 'Tiêu đề chủ đề không được dài quá 255 ký tự',

            'parentSubjectList.*.subjectId.not_in'      => 'Vui lòng chọn chủ đề cha',

            'branchSubjectList.*.subjectId.not_in'      => 'Vui lòng chọn chủ đề con',
        ];
    }

    public function getUpdateParam(): AdminSubjectUpdateParam
    {
        $updateParam = new AdminSubjectUpdateParam();

        $updateParam->setSubjectId($this->subjectId);
        $updateParam->setTitle($this->title);
        $updateParam->setLevel($this->level);
        $updateParam->setSequence($this->sequence);

        $updateParam->setParentSubjectList(new DreamerTypeList($this->parentSubjectList));
        $updateParam->setRemoveParentSubjectList(new DreamerTypeList($this->removeParentSubjectList));

        $updateParam->setBranchSubjectList(new DreamerTypeList($this->branchSubjectList));
        $updateParam->setRemoveBranchSubjectList(new DreamerTypeList($this->removeBranchSubjectList));

        $updateParam->setKnowledgeArticleList(new DreamerTypeList($this->knowledgeArticleList));
        $updateParam->setRemoveKnowledgeArticleList(new DreamerTypeList($this->removeKnowledgeArticleList));

        return $updateParam;
    }
}

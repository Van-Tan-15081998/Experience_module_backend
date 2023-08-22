<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $imageList
 * @property mixed $unitContentLeftSide
 * @property mixed $unitContentRightSide
 * @property mixed $unitContent
 * @property mixed $title
 * @property mixed $knowledgeArticleContentUnitId
 */
class KnowledgeArticleContentUnitUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'unitContent' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'Tiêu đề Unit là bắt buộc',
            'unitContent.required'            => 'Nội dung của Unit là bắt buộc',
        ];
    }

    public function getUpdateParam(): AdminKnowledgeArticleContentUnitUpdateParam
    {
        $updateParam = new AdminKnowledgeArticleContentUnitUpdateParam();

        $updateParam->setKnowledgeArticleContentUnitId($this->knowledgeArticleContentUnitId);
        $updateParam->setTitle($this->title);

        $updateParam->setUnitContent($this->unitContent);
        $updateParam->setUnitContentRightSide($this->unitContentRightSide);
        $updateParam->setUnitContentLeftSide($this->unitContentLeftSide);

        $updateParam->setImageList(new DreamerTypeList($this->imageList));

        return $updateParam;
    }
}

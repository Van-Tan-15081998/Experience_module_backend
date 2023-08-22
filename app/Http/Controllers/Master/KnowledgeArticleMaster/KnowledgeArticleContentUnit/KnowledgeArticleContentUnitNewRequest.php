<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitNewParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $imageList
 * @property mixed $unitContentLeftSide
 * @property mixed $unitContentRightSide
 * @property mixed $unitContent
 * @property mixed $title
 * @property mixed $knowledgeArticleId
 */
class KnowledgeArticleContentUnitNewRequest extends FormRequest
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
            'knowledgeArticleId' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'Tiêu đề của Unit là bắt buộc',
            'unitContent.required'            => 'Nội dung của Unit là bắt buộc',
            'knowledgeArticleId.required' => 'Vui lòng thêm Unit từ bài viết của bạn'
        ];
    }

    public function getNewParam(): AdminKnowledgeArticleContentUnitNewParam
    {
        $newParam = new AdminKnowledgeArticleContentUnitNewParam();

        $newParam->setKnowledgeArticleId($this->knowledgeArticleId);
        $newParam->setTitle($this->title);

        $newParam->setUnitContent($this->unitContent);
        $newParam->setUnitContentRightSide($this->unitContentRightSide);
        $newParam->setUnitContentLeftSide($this->unitContentLeftSide);

        $newParam->setImageList(new DreamerTypeList($this->imageList));

        return $newParam;
    }
}

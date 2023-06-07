<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleCondition;
use Illuminate\Foundation\Http\FormRequest;

class KnowledgeArticleListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

    public function getPageNo(): int
    {
        if ($this->has('currentPage')) {
            return (int) $this->currentPage;
        } else {
            return 1;
        }
    }

    public function getLimitCount(): int
    {
        if ($this->has('limitCount') && ($this->limitCount == 5 || $this->limitCount == 10 || $this->limitCount == 25 || $this->limitCount == 50 || $this->limitCount == 100)) {
            return (int) $this->limitCount;
        } else {
            return 10;
        }
    }

    public function getSearchCondition(): AdminKnowledgeArticleCondition
    {
        $condition = new AdminKnowledgeArticleCondition();

        if($this->has('searchCondition')) {
            // TODO
        }

        return $condition;
    }

    public function getExportCondition() {

    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Knowledge\Requests;

use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models\KnowledgeUpdateParam;
use App\Lib\Business\Common\Validator\BasicTextValidator;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class KnowledgeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'title' => [new BasicTextValidator(true, null, null)],
//            'content' => [new BasicTextValidator(true, null, null)],
            'title' => 'required',
            'content_knowledge' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    public function getUpdateParam(): KnowledgeUpdateParam {
        $updateParam = new KnowledgeUpdateParam();

        $updateParam->setTitle($this->title);
        $updateParam->setContent($this->content_knowledge);

        $updateParam->setParentKnowledgeCode($this->parent_knowledge_code);
        $updateParam->setSameLevelSequence($this->same_level_sequence);
        $updateParam->setTreeLevel($this->tree_level);

        return $updateParam;
    }
}

<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Knowledge;

use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Entities\KnowledgeEntity;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models\KnowledgeModel;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models\KnowledgeUpdateParam;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Requests\KnowledgeUpdateRequest;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerValidationBusinessException;
use App\Lib\Business\Common\Models\DreamerValidationErrors;
use Illuminate\Http\Request;

class KnowledgeBusiness extends ExperienceBaseBusiness
{
    private KnowledgeEntity $knowledgeEntity;

    public function __construct()
    {
        parent::__construct();
        $this->knowledgeEntity = new KnowledgeEntity();
    }

    public function save(KnowledgeUpdateRequest $request) : array {
//        $knowledge = new KnowledgeModel();
//        $knowledge->setParentKnowledgeCode($request->parent_knowledge_code);
//        $knowledge->setSameLevelSequence($request->same_level_sequence);
//        $knowledge->setTreeLevel($request->tree_level);
//        $knowledge->setTitle($request->title);
//        $knowledge->setContent($request->content_knowledge);
//
//        return $this->knowledgeEntity->add($knowledge);

        $updateParam = $request->getUpdateParam();

        $errors = $this->validateAddParams($updateParam);

        if(isset($errors)) {
            throw new DreamerValidationBusinessException($errors);
        }

        return $this->knowledgeEntity->add($updateParam);
    }

    public function getById(int $knowledgeId) : array {
        return $this->knowledgeEntity->getById($knowledgeId);
    }

    public function getAll() : array {
        return $this->knowledgeEntity->getAll();
    }

    public function getAllParentBySubjectCode(int $subjectCode) : array {
        return $this->knowledgeEntity->getAllParentBySubjectCode($subjectCode);
    }

    public function getChildrenByParentKnowledgeCode(int $parentKnowledgeCode) : array {
        return $this->knowledgeEntity->getChildrenByParentKnowledgeCode($parentKnowledgeCode);
    }

    public function validateAddParams(KnowledgeUpdateParam $updateParam): ?DreamerValidationErrors {
        $errors = new DreamerValidationErrors();

        // hàm này để validate các vấn đề liên quan, ngoại trừ validate của request như: bắt buộc nhập,...

        if($errors->empty()) {
            $errors = null;
        }

        return $errors;
    }
}

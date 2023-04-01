<?php

namespace App\Http\Controllers\Master\FavoriteApp\Knowledge;
use App\Http\Controllers\Controller;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\KnowledgeBusiness;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Requests\KnowledgeUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class KnowledgeController extends Controller
{
    private KnowledgeBusiness $knowledgeBusiness;

    public function __construct()
    {
        $this->knowledgeBusiness = new KnowledgeBusiness();
    }

    public function save(KnowledgeUpdateRequest $request): array {
        try {
            $data = $this->knowledgeBusiness->save($request);

            return $this->sentResponseSuccessful($data);

        } catch (\Exception $e) {
            return $this->sentResponseFail(100, $e->getMessage(), null);
        }
    }

    public function getById(Request $request) {
        try {
            $data = $this->knowledgeBusiness->getById($request->id);

            return $this->sentResponseSuccessful($data);

        } catch (\Exception $e) {
            return $this->sentResponseFail(100, $e->getMessage(), null);
        }
    }

    public function getAll() {
        try {
            $data = $this->knowledgeBusiness->getAll();

            return $this->sentResponseSuccessful($data);

        } catch (\Exception $e) {
            return $this->sentResponseFail(100, $e->getMessage(), null);
        }
    }

    public function getAllParentBySubjectCode(Request $request) {
        try {
            $data = $this->knowledgeBusiness->getAllParentBySubjectCode((int) $request->subjectCode);

            return $this->sentResponseSuccessful($data);

        } catch (\Exception $e) {
            return $this->sentResponseFail(100, $e->getMessage(), null);
        }
    }

    public function getChildrenByParentKnowledgeCode(Request $request) : array {
        try {
            $data = $this->knowledgeBusiness->getChildrenByParentKnowledgeCode((int) $request->parentKnowledgeCode);

            return $this->sentResponseSuccessful($data);

        } catch (\Exception $e) {
            return $this->sentResponseFail(100, $e->getMessage(), null);
        }
    }
}

<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\KnowledgeArticleMaster\MasterSearch\MasterSearchBaseController;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\MasterSearchBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use App\Lib\WebCommon\Helpers\ResponseStatus;
use App\Util\ResponseStatusHelper;
use Symfony\Component\HttpFoundation\Response;

class MasterSearchController extends MasterSearchBaseController
{
    private MasterSearchBusiness $masterSearchBusiness;

    public function __construct()
    {
        parent::__construct();
        $this->masterSearchBusiness = new MasterSearchBusiness();
    }

    public function search(MasterSearchRequest $request) {
        $data   = null;
        $status = null;

        $mode   = $request->actionMode;

        $screenOptional = [
            parent::OPTIONAL_MODE => $mode
        ];

        $resultArray = $this->getSearch($request);

        $data = $resultArray['data'];
        $status = $resultArray['status'];

        return $this->responseOnSuccessfulWithCommonFields($data, $status, $screenOptional);
    }

    public function getSearch(MasterSearchRequest $request) {

        $response = null;

        $isSucceeded = false;
        $data = new ResponseArrayModel();
        $status = null;

        try {

            $searchResult = $this->masterSearchBusiness->search($request);

            $data->addResponseItem('data', $searchResult);

            $isSucceeded = true;

        } catch (DreamerBusinessException $e) {

        }

        return [
            "data" => $data,
            "status" => $status
        ];
    }

    private function responseOnSuccessfulWithCommonFields(  DreamerTypeObject $data = null,
                                                            ResponseStatus $status = null,
                                                            array $screenOptional=null      ): Response
    {
        return $this->apiResponseWithCommonFields(
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_MASTER_SEARCH(),
            AdminPageType::MASTER_KNOWLEDGE_ARTICLE_MASTER_SEARCH(),
            $data,
            ResponseStatusHelper::toList($status),
            $screenOptional
        );
    }
}

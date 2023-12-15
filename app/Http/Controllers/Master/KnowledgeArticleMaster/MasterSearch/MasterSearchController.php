<?php

namespace App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch;

use App\Constants\AdminPageType;
use App\Http\Controllers\Base\KnowledgeArticleMaster\MasterSearch\MasterSearchBaseController;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\MasterSearchBusiness;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Type\DreamerTypeObject;
use App\Lib\WebCommon\Constants\MessageType;
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

//        $resultArray = $this->getSearch($request);
        $resultArray = $this->getInitialDisplayData($request);

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

    private function getInitialDisplayData(MasterSearchRequest $request): array
    {
        $data   = new ResponseArrayModel();
        $status = null;

        $isSucceeded = false;

        try {
            $page               = $this->masterSearchBusiness->getPage($request);
            $data->addResponseItem('page', $page);

            $isSucceeded    = true;
        } catch (DreamerBusinessException $e) {

            $code       = $e->getExceptionCode();

            $errMessage = $this->getErrorMessage($code,
                'Get Data Error');

            $status     = ResponseStatus::createErrorStatus(
                $code,
                $e->getExceptionMessage(),
                $errMessage
            );
        }

        if($isSucceeded) {

                // TODO
                try {
                    $selectionItems = new ResponseArrayModel();

                    $selectionItems = $this->masterSearchBusiness->getSelectionItems();

                    $selectionItems = $selectionItems->toArray();

                    // Nếu có bất cứ một item nào trong list là rỗng thì báo lỗi
                    if ($selectionItems['isExistsEmptyList']) {
                        $status = ResponseStatus::createSuccessfulStatus(
                            MessageType::ERROR(),
                            __('admin_common_message.common_err_noMasterData_00-03-000004')
                        );
                    }

                    $data->addResponseItem('selectionItems', $selectionItems['searchItems']);
                } catch (DreamerBusinessException $e) {

                    $status = ResponseStatus::createErrorStatus(
                        $e->getExceptionCode(),
                        $e->getExceptionMessage(),
                    );
                }
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

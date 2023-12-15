<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch;

use App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch\MasterSearchRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Entities\MasterSearchEntity;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Models\AdminMasterSearchPaginationModel;
use App\Lib\Business\Base\ExperienceBaseBusiness;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\WebCommon\Helpers\ResponseArrayModel;
use Illuminate\Support\Facades\App;

class MasterSearchBusiness extends ExperienceBaseBusiness
{
    private MasterSearchEntity $masterSearchEntity;

    public function __construct()
    {
        parent::__construct();
        $this->masterSearchEntity = App::make(MasterSearchEntity::class);
    }

    public function search(MasterSearchRequest $request) {

        // Get search params
        $searchParam = $request->getSearchParam();

        return $this->masterSearchEntity->search($searchParam);
    }

    public function getPage(MasterSearchRequest $request): AdminMasterSearchPaginationModel
    {
        $pageInfo = new PageInfo($request->getPageNo(), $request->getLimitCount());

//        $condition = $request->getSearchCondition();
        $condition = $request->getSearchParam();

        return $this->masterSearchEntity->getPage($pageInfo, $condition);
    }

    public function getSelectionItems(): ResponseArrayModel
    {
        $selectionItems = new ResponseArrayModel();
        $isExistEmptyList = false;

        // Get Tag list
        $tagList = $this->getTagList();

        $selectionItems->addResponseItem('tagList', $tagList);

        $result = new ResponseArrayModel();
        $result->addResponseItem('searchItems', $selectionItems);
        $result->addResponseItem('isExistsEmptyList', $isExistEmptyList);

        return $result;
    }

    public function getTagList(): DreamerTypeList
    {
        $result = null;

        try {

            $result = $this->masterSearchEntity->getTagList();

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $result;
    }
}

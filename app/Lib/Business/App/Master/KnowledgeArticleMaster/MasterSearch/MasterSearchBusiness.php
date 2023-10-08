<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch;

use App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch\MasterSearchRequest;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\MasterSearch\Entities\MasterSearchEntity;
use App\Lib\Business\Base\ExperienceBaseBusiness;
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
}

<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminDefaultTagColorModel;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DefaultTagColorEntity  extends Model
{
    public function selectDefaultTagColorList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__tag_default_colors";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $defaultTagColorList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $defaultTagColor = AdminDefaultTagColorModel::createFromRecord($record);
            $defaultTagColorList->add($defaultTagColor);
        }

        return $defaultTagColorList;
    }
}

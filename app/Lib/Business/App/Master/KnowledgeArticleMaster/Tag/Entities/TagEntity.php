<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagCondition;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Tag\Models\AdminTagUpdateParam;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Core\DataSource\Models\PageInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationInfo;
use App\Lib\Common\Core\DataSource\Models\PaginationModel;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Util\DreamerStringUtil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagEntity  extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'title',
        'color',
        'title_slug',
        'level',
        'sequence',

        'created_account_id',
        'created_account_login_id',
        'created_account_name',
        'created_datetime',
        'updated_account_id',
        'updated_account_login_id',
        'updated_account_name',
        'updated_datetime',
        'record_version',
        'is_deleted'
    ];

    protected $table = 'kam__tags';
    protected $primaryKey = 'tag_id';

    public function getPage(PageInfo $pageInfo, AdminTagCondition $condition): ?AdminTagPaginationModel
    {
        $page = null;

        try {
            $page = $this->paginateByCondition($pageInfo, $condition);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $page;
    }

    public function paginateByCondition(PageInfo $pageInfo, AdminTagCondition $condition = null): AdminTagPaginationModel
    {
        $result = [];

        /**
         * // Câu query chỉ get danh sách Root Subject
         **/
        $query =
            "SELECT *"
            . " FROM kam__tags"
            . " WHERE kam__tags.is_deleted = 0"
            .       " AND kam__tags.level = 1";

        if (!is_null($condition)) {
            $query .= '';
            // TODO
        }

        return $this->paginate($query, $pageInfo, new AdminTagPaginationModel());
    }

    protected function paginate(string $query,
                                PageInfo $pageInfo,
                                PaginationModel $paginationModelClass,
                                string $paginateFunctionName = null
    ): PaginationModel
    {
        $start = $pageInfo->getStartPage();

        if ($start < 1) {
            $start = 1;
        }

        $limit = $pageInfo->getLimitCount();

        $originalQuery = $query;

        $query .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

        $data = DB::select($query);

        $cnt = 0;

        if(count($data) > 0) {

            $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
            $countResultExecute = DB::select($countResultQuery);

            $cnt = $countResultExecute[0]->paginate_total_count;
        } else {
            if($start > 1) {

                $start = 1;

                $originalQuery .= " LIMIT " . (($start - 1) * $limit) . " , " . $limit;

                $data = DB::select($originalQuery);

                if(count($data) > 0) {
                    $countResultQuery = 'SELECT COUNT(*) as paginate_total_count FROM (' . $originalQuery . ') AS subquery;';
                    $countResultExecute = DB::select($countResultQuery);

                    $cnt = $countResultExecute[0]->paginate_total_count;
                }
            }
        }

        $lastPage = (int) ceil($cnt / $limit);

        $paginationInfo = new PaginationInfo();
        $paginationInfo->setCurrentPage($start);
        $paginationInfo->setTotalPages($lastPage);
        $paginationInfo->setLimitCount($limit);
        $paginationInfo->setTotalCount($cnt);

        $modelClass = get_Class($paginationModelClass);
        $return = new $modelClass();
        $return->setPaginationInfo($paginationInfo);

        if(!isset($paginateFunctionName)) {
            $paginateFunctionName = 'convertResult';
        }

        $return->$paginateFunctionName($data);

        return $return;
    }

    public function getById(int $tagId): AdminTagModel
    {
        $detail = null;

        try {
            $detail = $this->selectById($tagId);


        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function getEditTagById(int $tagId): AdminTagModel
    {
        $detail = null;

        try {
            $detail = $this->selectEditTagById($tagId);


        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectById(int $tagId): ?AdminTagModel
    {
        $query =
            "SELECT *"
            . " FROM kam__tags"
            . " WHERE kam__tags.tag_id = " . $tagId
            . " AND kam__tags.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminTag =  AdminTagModel::createFromRecord($result[0]);

        return $adminTag;
    }

    public function selectEditTagById(int $tagId): ?AdminTagModel
    {
        $query =
            "SELECT *"
            . " FROM kam__tags"
            . " WHERE kam__tags.tag_id = " . $tagId
            . " AND kam__tags.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminTag =  AdminTagModel::createFromRecordForEdit($result[0]);

        return $adminTag;
    }

    public function insertTag(AdminTagUpdateParam $param): int
    {
        $tagId = DB::table('kam__tags')->insertGetId(
            [
                'title'     => $param->getTitle(),
                'title_slug' => DreamerStringUtil::toSlug($param->getTitle()),
                'color'     => $param->getColor(),
                'level'     => $param->getLevel(),
                'sequence'  => $param->getSequence(),
            ]
        );

        return $tagId;
    }

    public function updateTag(AdminTagUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__tags')
            ->where('tag_id', '=', $param->getTagId())
            ->update([
                'title'     => $param->getTitle(),
                'level'     => $param->getLevel(),
                'color'     => $param->getColor(),
                'sequence'  => $param->getSequence(),
            ]);

        return $param->getTagId();
    }

    public function deleteTag(AdminTagUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__tags')
            ->where('tag_id', '=', $param->getTagId())
            ->update([
                'is_deleted'     => true
            ]);

        return $param->getTagId();
    }

    public function revertDeleteTag(AdminTagUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__tags')
            ->where('tag_id', '=', $param->getTagId())
            ->update([
                'is_deleted'     => false
            ]);

        return $param->getTagId();
    }

    public function getTagList(): DreamerTypeList
    {
        return $this->selectTagList();
    }

    public function selectTagList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__tags"
            . " WHERE kam__tags.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $tagList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $tag = AdminTagModel::createFromRecord($record);
            $tagList->add($tag);
        }

        return $tagList;
    }
}


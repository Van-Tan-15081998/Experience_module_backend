<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticle\Models\AdminKnowledgeArticleModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectCondition;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectPaginationModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\Subject\Models\AdminSubjectUpdateParam;
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

/**
 *  Quy tắc
 *  +   Các phương thức gọi từ Business: Phương thức Public
 *      - get   :
 *              -- getAll
 *              -- getById
 *              -- getPage
 *      - do    :
 *              -- doInsert
 *              -- doUpdate
 *              -- doDelete
 *  +   Các phương thức thao tác trực tiếp với Database: Phương thức Private
 *      - _select    (   =>  Sử dụng câu lệnh SQL thuần)        [ _selectAll , _selectById , _selectPage , ... ]
 *      - _insert    (   =>  Sử dụng Query builder của Laravel) [ _insert , ... ]
 *      - _update    (   =>  Sử dụng Query builder của Laravel) [ _update , ... ]
 *      - _delete    (   =>  Sử dụng Query builder của Laravel) [ _delete , ... ]
 *      - ...
 *
 *  +   Example:
 *      public function getAll() {
 *          $data = $this->_selectAll();
 *          return $data;
 *      }
 *  +   Bookmarks
 *      // TODO: [Bookmark] __________[ getAll ]__________</>
 *      // TODO: [Bookmark] __________[ getById ]__________</>
 *      // TODO: [Bookmark] __________[ getPage ]__________</>
 *      // TODO: [Bookmark] __________[ doInsert ]__________</>
 *      // TODO: [Bookmark] __________[ doUpdate ]__________</>
 *      // TODO: [Bookmark] __________[ doDelete ]__________</>
 */

class SubjectEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'subject_id',
        'title',
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

    protected $table = 'kam__subjects';
    protected $primaryKey = 'subject_id';

    public function getPage(PageInfo $pageInfo, AdminSubjectCondition $condition): ?AdminSubjectPaginationModel
    {
        $page = null;

        try {
            $page = $this->paginateByCondition($pageInfo, $condition);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        return $page;
    }

    public function paginateByCondition(PageInfo $pageInfo, AdminSubjectCondition $condition = null): AdminSubjectPaginationModel
    {
        $result = [];

        /**
         * // Câu query chỉ get danh sách Root Subject
        **/
        $query =
            "SELECT *"
            . " FROM kam__subjects"
            . " WHERE kam__subjects.is_deleted = 0"
            .       " AND kam__subjects.level = 1";

        if (!is_null($condition)) {
            $query .= '';
            // TODO
        }

        return $this->paginate($query, $pageInfo, new AdminSubjectPaginationModel());
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

    public function getById(int $subjectId): AdminSubjectModel
    {
        $detail = null;

        try {
            $detail = $this->selectById($subjectId);


        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function getEditSubjectById(int $subjectId): AdminSubjectModel
    {
        $detail = null;

        try {
            $detail = $this->selectEditSubjectById($subjectId);


        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectById(int $subjectId): ?AdminSubjectModel
    {
        $query =
            "SELECT *"
            . " FROM kam__subjects"
            . " WHERE kam__subjects.subject_id = " . $subjectId
            . " AND kam__subjects.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminSubject =  AdminSubjectModel::createFromRecord($result[0]);

        return $adminSubject;
    }

    public function selectEditSubjectById(int $subjectId): ?AdminSubjectModel
    {
        $query =
            "SELECT *"
            . " FROM kam__subjects"
            . " WHERE kam__subjects.subject_id = " . $subjectId
            . " AND kam__subjects.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminSubject =  AdminSubjectModel::createFromRecordForEdit($result[0]);

        return $adminSubject;
    }

    public function insertSubject(AdminSubjectUpdateParam $param): int
    {
        $subjectId = DB::table('kam__subjects')->insertGetId(
            [
                'title'     => $param->getTitle(),
                'title_slug' => DreamerStringUtil::toSlug($param->getTitle()),
                'level'     => $param->getLevel(),
                'sequence'  => $param->getSequence(),
            ]
        );

        // Nếu subject có level = 1 => subject gốc => bỏ qua insert danh sách subject cha nếu có
        if($param->getLevel() !== 1) {
            $this->insertParentSubjectList($subjectId, $param->getParentSubjectList());
        }

        $this->insertBranchSubjectList($subjectId, $param->getBranchSubjectList());

        return $subjectId;
    }

    private function insertParentSubjectList(int $subjectId, DreamerTypeList $parentSubjectList): void
    {
        /**
         * $parentSubjectList là tham số dạng mảng:
         * [
         *  { subjectId : 1 },
         *  { subjectId : 2 },
         *  { subjectId : 3 },
         * ]
         **/
        if(!$parentSubjectList->empty()) {
            foreach ($parentSubjectList->getList() as $parentSubject) {
                DB::table('kam__subject_branch_subject_allocations')->insert([
                    ['subject_id' => $parentSubject['subjectId'], 'branch_subject_id' => $subjectId],
                ]);
            }
        }
    }

    private function insertBranchSubjectList(int $subjectId, DreamerTypeList $branchSubjectList): void
    {
        /**
         * $branchSubjectList là tham số dạng mảng:
         * [
         *  { subjectId : 1 },
         *  { subjectId : 2 },
         *  { subjectId : 3 },
         * ]
         **/
        if(!$branchSubjectList->empty()) {
            foreach ($branchSubjectList->getList() as $branchSubject) {
                DB::table('kam__subject_branch_subject_allocations')->insert([
                    ['subject_id' => $subjectId, 'branch_subject_id' => $branchSubject['subjectId']],
                ]);
            }
        }
    }

    public function updateSubject(AdminSubjectUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__subjects')
            ->where('subject_id', '=', $param->getSubjectId())
            ->update([
                'title'     => $param->getTitle(),
                'level'     => $param->getLevel(),
                'sequence'  => $param->getSequence(),
            ]);

        $this->doUpdateParentSubject($param->getSubjectId(), $param);

        $this->doUpdateBranchSubject($param->getSubjectId(), $param);

        return $param->getSubjectId();
    }

    public function doUpdateParentSubject(int $subjectId, AdminSubjectUpdateParam $param)
    {
        // Params for update or insert
        $insertOrUpdateParams = $param->getParentSubjectList()->getList();

        // Params for update
        $updateParams = new DreamerTypeList([]);
        // Params for insert
        $insertParams = new DreamerTypeList([]);

        foreach ($insertOrUpdateParams as $_param) {
            if (!isset($_param['subjectBranchSubjectId'])) {
                $insertParams->add($_param);
            } else {
                $updateParams->add($_param);
            }
        }

        //---------------------------------------------------------
        // INSERT
        // Khi thêm mới, dữ liệu parentSubject truyền về Backend là tham số dạng
        /**
         * $parentSubject là tham số dạng mảng:
         * [
         *  { subjectId : 1 },
         *  { subjectId : 2 },
         *  { subjectId : 3 },
         * ]
         **/
        //---------------------------------------------------------
        $this->insertParentSubjectList($subjectId, $insertParams);

        //---------------------------------------------------------
        // UPDATE
        // Khi lấy dữ liệu cập nhật, dữ liệu parentSubjectList truyền đến Frontend và truyền về Backend sẽ là tham số dạng
        /**
         * [
         *  { subjectBranchSubjectId, subjectId : 1 },
         *  { subjectBranchSubjectId, subjectId : 2 },
         *  { subjectBranchSubjectId, subjectId : 3 },
         * ]
         * => subjectBranchSubjectId là key của table trung gian - kam__subject_branch_subject_allocations
         **/
        //---------------------------------------------------------
        $this->updateParentSubjectList($subjectId, $updateParams);

        //---------------------------------------------------------
        // DELETE LOGICAL
        //---------------------------------------------------------
        // Params for delete
        $deleteParams = $param->getRemoveParentSubjectList();

        if(!$deleteParams->empty()) {
            $this->deleteLogicalParentSubjectList($subjectId, $deleteParams->getList());
        }
    }

    private function updateParentSubjectList(int $subjectId, DreamerTypeList $parentSubjectList): void
    {
        foreach ($parentSubjectList->getList() as $param) {
            DB::table('kam__subject_branch_subject_allocations')
                ->where('subject_branch_subject_allocation_id', '=', $param['subjectBranchSubjectId'])
                ->update(['subject_id' => $param['subjectId']]);
        }
    }

    public function doUpdateBranchSubject(int $subjectId, AdminSubjectUpdateParam $param)
    {
        // Params for update or insert
        $insertOrUpdateParams = $param->getBranchSubjectList()->getList();

        // Params for update
        $updateParams = new DreamerTypeList([]);
        // Params for insert
        $insertParams = new DreamerTypeList([]);

        foreach ($insertOrUpdateParams as $_param) {
            if (!isset($_param['subjectBranchSubjectId'])) {
                $insertParams->add($_param);
            } else {
                $updateParams->add($_param);
            }
        }

        //---------------------------------------------------------
        // INSERT
        // Khi thêm mới, dữ liệu branchSubject truyền về Backend là tham số dạng
        /**
         * $branchSubject là tham số dạng mảng:
         * [
         *  { subjectId : 1 },
         *  { subjectId : 2 },
         *  { subjectId : 3 },
         * ]
         **/
        //---------------------------------------------------------
        $this->insertBranchSubjectList($subjectId, $insertParams);

        //---------------------------------------------------------
        // UPDATE
        // Khi lấy dữ liệu cập nhật, dữ liệu branchSubjectList truyền đến Frontend và truyền về Backend sẽ là tham số dạng
        /**
         * [
         *  { subjectBranchSubjectId, subjectId : 1 },
         *  { subjectBranchSubjectId, subjectId : 2 },
         *  { subjectBranchSubjectId, subjectId : 3 },
         * ]
         * => subjectBranchSubjectId là key của table trung gian - kam__subject_branch_subject_allocations
         **/
        //---------------------------------------------------------
        $this->updateBranchSubjectList($subjectId, $updateParams);

        //---------------------------------------------------------
        // DELETE LOGICAL
        //---------------------------------------------------------
        // Params for delete
        $deleteParams = $param->getRemoveBranchSubjectList();

        if(!$deleteParams->empty()) {
            $this->deleteLogicalBranchSubjectList($subjectId, $deleteParams->getList());
        }
    }

    private function updateBranchSubjectList(int $subjectId, DreamerTypeList $parentSubjectList): void
    {
        foreach ($parentSubjectList->getList() as $param) {
            DB::table('kam__subject_branch_subject_allocations')
                ->where('subject_branch_subject_allocation_id', '=', $param['subjectBranchSubjectId'])
                ->update(['branch_subject_id' => $param['subjectId']]);
        }
    }

    public function doUpdateKnowledgeArticle(int $subjectId, AdminSubjectUpdateParam $param)
    {

    }

    public function getParentSubjectListBySubjectId(int $subjectId): DreamerTypeList
    {
        return $this->selectParentSubjectListBySubjectId($subjectId);
    }

    public function getBranchSubjectListBySubjectId(int $subjectId): DreamerTypeList
    {
        return $this->selectBranchSubjectListBySubjectId($subjectId);
    }

    public function getKnowledgeArticleListBySubjectId(int $subjectId): DreamerTypeList
    {
        return $this->selectKnowledgeArticleListBySubjectId($subjectId);
    }

    public function selectParentSubjectListBySubjectId(int $subjectId): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__subject_branch_subject_allocations"
            . " JOIN kam__subjects"
            .   " ON kam__subject_branch_subject_allocations.subject_id = kam__subjects.subject_id"
            .   " AND kam__subjects.is_deleted = 0"
            . " WHERE kam__subject_branch_subject_allocations.branch_subject_id = " . $subjectId
            .   " AND kam__subject_branch_subject_allocations.is_deleted = 0";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $parentSubjectList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $parentSubject = AdminSubjectModel::createFromRecordSpecial($record);
            $parentSubjectList->add($parentSubject);
        }

        return $parentSubjectList;
    }

    public function selectBranchSubjectListBySubjectId(int $subjectId): DreamerTypeList
    {
//        $query =
//            "SELECT *"
//            . " FROM kam__subjects"
//            . " JOIN kam__subject_branch_subject_allocations"
//            . " ON kam__subject_branch_subject_allocations.is_deleted = 0 "
//            .   " AND kam__subject_branch_subject_allocations.subject_id = " . $subjectId
//            .   " AND kam__subject_branch_subject_allocations.branch_subject_id = kam__subjects.subject_id"
//            . " WHERE kam__subjects.is_deleted = 0";

        $query =
            "SELECT *"
            . " FROM kam__subject_branch_subject_allocations"
            . " JOIN kam__subjects"
            .   " ON kam__subject_branch_subject_allocations.branch_subject_id = kam__subjects.subject_id"
            .   " AND kam__subjects.is_deleted = 0"
            . " WHERE kam__subject_branch_subject_allocations.subject_id = " . $subjectId
            .   " AND kam__subject_branch_subject_allocations.is_deleted = 0";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $branchSubjectList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $branchSubject = AdminSubjectModel::createFromRecordSpecial($record);
            $branchSubjectList->add($branchSubject);
        }

        return $branchSubjectList;
    }

    public function selectKnowledgeArticleListBySubjectId(int $subjectId): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"

            . " JOIN kam__subject_knowledge_article_allocations"
            . " ON kam__subject_knowledge_article_allocations.knowledge_article_id = kam__knowledge_articles.knowledge_article_id"
            . " AND kam__subject_knowledge_article_allocations.subject_id = " . $subjectId
            . " AND kam__subject_knowledge_article_allocations.is_deleted = 0"

            . " WHERE kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $knowledgeArticleList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $knowledgeArticle = AdminKnowledgeArticleModel::createFromRecord($record);
            $knowledgeArticleList->add($knowledgeArticle);
        }

        return $knowledgeArticleList;
    }

    public function getSubjectList(): DreamerTypeList
    {
        return $this->selectSubjectList();
    }

    public function getKnowledgeArticleList(): DreamerTypeList
    {
        return $this->selectKnowledgeArticleList();
    }

    public function selectSubjectList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__subjects"
            . " WHERE kam__subjects.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $subjectList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $subject = AdminSubjectModel::createFromRecord($record);
            $subjectList->add($subject);
        }

        return $subjectList;
    }

    public function selectKnowledgeArticleList(): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $knowledgeArticleList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $knowledgeArticle = AdminKnowledgeArticleModel::createFromRecord($record);
            $knowledgeArticleList->add($knowledgeArticle);
        }

        return $knowledgeArticleList;
    }

    private function deleteLogicalParentSubjectList(int $subjectId, array $deleteParams): void
    {
        foreach ($deleteParams as $param) {
            DB::table('kam__subject_branch_subject_allocations')
                ->where('subject_branch_subject_allocation_id', '=', $param['subjectBranchSubjectId'])
                ->update(['is_deleted' => true]);
        }
    }

    private function deleteLogicalBranchSubjectList(int $subjectId, array $deleteParams): void
    {
        foreach ($deleteParams as $param) {
            DB::table('kam__subject_branch_subject_allocations')
                ->where('subject_branch_subject_allocation_id', '=', $param['subjectBranchSubjectId'])
                ->update(['is_deleted' => true]);
        }
    }
}

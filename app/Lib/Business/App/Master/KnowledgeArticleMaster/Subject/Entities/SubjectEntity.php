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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'subject_id',
        'title',
        'level',
        'sequence',
        'parent_subject_code',
        'root_subject_code',

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
            .       " AND kam__subjects.level = 1"
            .       " AND kam__subjects.parent_subject_code = 0"
        ;

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
            $detail = $this->selectEditBoothById($subjectId);


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

    public function selectEditBoothById(int $subjectId): ?AdminSubjectModel
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
                'level'     => $param->getLevel(),
                'sequence'  => $param->getSequence(),
                'parent_subject_code'   => $param->getParentSubjectCode(),
                'root_subject_code'     => $param->getRootSubjectCode()
            ]
        );

        return $subjectId;
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
                'parent_subject_code'   => $param->getParentSubjectCode(),
                'root_subject_code'     => $param->getRootSubjectCode()
            ]);

        return $param->getSubjectId();
    }

    public function getBranchSubjectList(int $subjectId): DreamerTypeList
    {
        return $this->selectBranchSubjectList($subjectId);
    }

    public function getKnowledgeArticleList(int $subjectId): DreamerTypeList
    {
        return $this->selectKnowledgeArticleList($subjectId);
    }

    public function selectBranchSubjectList(int $subjectId): DreamerTypeList
    {
        $query =
            "SELECT *"
            . " FROM kam__subjects"
            . " WHERE kam__subjects.is_deleted = 0 "
            .   " AND kam__subjects.parent_subject_code = " . $subjectId;

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return new DreamerTypeList([]);
        }

        $branchSubjectList = new DreamerTypeList([]);

        foreach ($result as $record) {
            $branchSubject = AdminSubjectModel::createFromRecord($record);
            $branchSubjectList->add($branchSubject);
        }

        return $branchSubjectList;
    }

    public function selectKnowledgeArticleList(int $subjectId): DreamerTypeList
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
}

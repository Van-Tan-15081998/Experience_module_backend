<?php

namespace App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Entities;

use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitModel;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitNewParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\AdminKnowledgeArticleContentUnitUpdateParam;
use App\Lib\Business\App\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\Models\KnowledgeArticleImageContentUnit\KnowledgeArticleImageContentUnitModel;
use App\Lib\Business\Common\Exception\DreamerBusinessException;
use App\Lib\Business\Common\Exception\DreamerExceptionConverter;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\Common\Type\DreamerTypeList;
use App\Lib\Common\Util\DreamerStringUtil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

class KnowledgeArticleContentUnitEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'knowledge_article_content_unit_id',
        'title',
        'title_slug',

        'content',
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

    protected $table = 'kam__knowledge_article_content_units';
    protected $primaryKey = 'knowledge_article_content_unit_id';

    public function getById(int $subjectId): AdminKnowledgeArticleContentUnitModel
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

    public function selectById(int $knowledgeArticleContentUnitId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_article_content_units"
            . " WHERE kam__knowledge_article_content_units.knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_content_units.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticleContentUnit =  AdminKnowledgeArticleContentUnitModel::createFromRecord($result[0]);

        $adminKnowledgeArticleContentUnit->setImageList($this->selectKnowledgeArticleImageContentUnitByKnowledgeArticleContentUnitId($knowledgeArticleContentUnitId));

        return $adminKnowledgeArticleContentUnit;
    }

    public function getEditKnowledgeArticleById(int $knowledgeArticleId): AdminKnowledgeArticleContentUnitModel
    {
        $detail = null;

        try {
            $detail = $this->selectEditKnowledgeArticleById($knowledgeArticleId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectEditKnowledgeArticleContentUnitByKnowledgeArticleId(int $knowledgeArticleId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_articles"
            . " WHERE kam__knowledge_articles.knowledge_article_id = " . $knowledgeArticleId
            . " AND kam__knowledge_articles.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticle =  AdminKnowledgeArticleContentUnitModel::createFromRecordForEdit($result[0]);

        return $adminKnowledgeArticle;
    }

    public function getEditKnowledgeArticleContentUnitById($knowledgeArticleContentUnitId)
    {
        $detail = null;

        try {
            $detail = $this->selectEditKnowledgeArticleContentUnitById($knowledgeArticleContentUnitId);

        } catch (\Exception $e) {
            DreamerExceptionConverter::convertException($e);
        }

        if(is_null($detail)) {
            throw new DreamerBusinessException( DreamerCommonErrorCode::E00000000002()->getCode(),
                DreamerCommonErrorCode::E00000000002()->getDescription());
        }

        return $detail;
    }

    public function selectEditKnowledgeArticleContentUnitById(int $knowledgeArticleContentUnitId): ?AdminKnowledgeArticleContentUnitModel
    {
        $query =
            "SELECT *"
            . " FROM kam__knowledge_article_content_units"
            . " WHERE kam__knowledge_article_content_units.knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_content_units.is_deleted = 0 ";

        $result = DB::select($query);

        if (is_null($result) || empty($result)) {
            return null;
        }

        $adminKnowledgeArticleContentUnit =  AdminKnowledgeArticleContentUnitModel::createFromRecordForEdit($result[0]);

        $adminKnowledgeArticleContentUnit->setImageList($this->selectKnowledgeArticleImageContentUnitByKnowledgeArticleContentUnitId($knowledgeArticleContentUnitId));

        return $adminKnowledgeArticleContentUnit;
    }

    public function selectKnowledgeArticleImageContentUnitByKnowledgeArticleContentUnitId(int $knowledgeArticleContentUnitId) : DreamerTypeList
    {
        $result = new DreamerTypeList();

        // Get images
        $queryGetImages =
            "SELECT *"
            . " FROM kam__knowledge_article_image_content_units"
            . " WHERE knowledge_article_content_unit_id = " . $knowledgeArticleContentUnitId
            . " AND kam__knowledge_article_image_content_units.is_deleted = 0 ";

        $imageQueryResult = DB::select($queryGetImages);

        if (is_null($imageQueryResult) || empty($imageQueryResult)) {
            return new DreamerTypeList();
        }

        foreach ($imageQueryResult as $image) {
            $result->add(KnowledgeArticleImageContentUnitModel::createFromRecord($image));
        }

        return $result;
    }



    public function insertKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitNewParam $param): int
    {
        $knowledgeArticleContentUnitId = DB::table('kam__knowledge_article_content_units')->insertGetId(
            [
                'title'     => $param->getTitle(),
                'title_slug' => DreamerStringUtil::toSlug($param->getTitle()),
                'unit_content'   => $param->getUnitContent()
            ]
        );

        if($knowledgeArticleContentUnitId) {

            $slugTitle = DreamerStringUtil::toSlug($param->getTitle());

            DB::table('kam__ka_ka_content_unit_allocations')->insert(
                [
                    'knowledge_article_id'  => $param->getKnowledgeArticleId(),
                    'knowledge_article_content_unit_id' => $knowledgeArticleContentUnitId,
                ]
            );

            // TODO: UPLOAD_FILE
            // TODO: Lưu ý lỗi: https://stackoverflow.com/questions/34009844/gd-library-extension-not-available-with-this-php-installation-ubuntu-nginx

            if($param->getImageList()->count() > 0) {
                foreach ($param->getImageList()->getList() as $key => $image) {
                    if($image) {
                        // Create name
                        $name = $knowledgeArticleContentUnitId . '_' . $key . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

                        // Create path
                        $path = 'images/knowledge_article_master/knowledge_article_content_unit/'
                                    .$knowledgeArticleContentUnitId . '_' . $slugTitle . '/';

                        if($this->createDirectory($path)) {
                            \Image::make($image)->save(public_path($path).$name);

                            DB::table('kam__knowledge_article_image_content_units')->insert(
                                [
                                    'knowledge_article_content_unit_id' => $knowledgeArticleContentUnitId,
                                    'image_title' => 'Tên ảnh',
                                    'image_source' => $path.$name
                                ]
                            );
                        }
                    }
                }
            }
        }

        return $knowledgeArticleContentUnitId;
    }

    private function _insertKnowledgeArticleContentUnitImageToStorage(AdminKnowledgeArticleContentUnitNewParam $param) {
        // Storage => /images/knowledge_article_master/ma_don_vi_ + _ten_don_vi_(slug)/thu_tu_anh
        // VD: /images/knowledge_article_master/knowledge_article_content_unit/123_giai_thuong_vat_ly/123_giai_thuong_vat_ly_time.jpg
        //                                                                                            123_giai_thuong_vat_ly_time.jpg
        //                                                                                            123_giai_thuong_vat_ly_time.jpg
        $images = $param->getImageList()->getList();

        foreach($images as $key => $image) {
            if($image)
            {
                $name = $key . time(). '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

                // Create path
                $path = 'images/knowledge_article_master/knowledge_article_content_unit/';

                if($this->createDirectory($path)) {
                    \Image::make($image)->save(public_path($path).$name);
                }
            }
        }
    }

    public function createDirectory($path) : bool
    {
        $path = public_path($path);

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        return File::isDirectory($path);
    }

    public function updateKnowledgeArticleContentUnit(AdminKnowledgeArticleContentUnitUpdateParam $param): int
    {
        /**
         * Hàm update của Laravel (Query builder) sẽ trả về id của record vừa update thành công
         **/
        DB::table('kam__knowledge_article_content_units')
            ->where('knowledge_article_content_unit_id', '=', $param->getKnowledgeArticleContentUnitId())
            ->update([
                'title'     => $param->getTitle(),
                'unit_content' => $param->getUnitContent()
            ]);

        return $param->getKnowledgeArticleContentUnitId();
    }
}

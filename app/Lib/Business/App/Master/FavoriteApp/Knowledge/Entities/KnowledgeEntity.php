<?php

namespace App\Lib\Business\App\Master\FavoriteApp\Knowledge\Entities;

use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models\KnowledgeModel;
use App\Lib\Business\App\Master\FavoriteApp\Knowledge\Models\KnowledgeUpdateParam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KnowledgeEntity extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'knowledge_id',
        'title',
        'content',
        'citation_source',
        'same_level_sequence',
        'parent_knowledge_code',
        'subject_code',
        'picture',
        'is_important',
        'border_color',
        'is_favourite',
        'size_picture',
        'tree_level'
    ];

    protected $table = 'favorite_app__knowledge';
    protected $primaryKey = 'knowledge_id';

    public function getById(int $knowledgeId) : array {
        $result = DB::table('favorite_app__knowledge')
            ->where('knowledge_id', $knowledgeId)
            ->select(
                'knowledge_id',
                'title',
                'content',
                'citation_source',
                'same_level_sequence',
                'parent_knowledge_code',
                'subject_code',
                'picture',
                'is_important',
                'border_color',
                'is_favourite',
                'size_picture',
                'tree_level'
            )->get()->toArray();

        if (empty($result)) {
            return [];
        }

        $result = KnowledgeModel::createFromRecord($result[0]);
        $result = $result->toArray();

        return $result;
    }

    public function getAll() : array {
        $result = [];
        $knowledgeList = DB::table('favorite_app__knowledge')
            ->select(
                'knowledge_id',
                'title',
                'content',
                'citation_source',
                'same_level_sequence',
                'parent_knowledge_code',
                'subject_code',
                'picture',
                'is_important',
                'border_color',
                'is_favourite',
                'size_picture',
                'tree_level'
            )->get()->toArray();

        if (empty($knowledgeList)) {
            return [];
        }

        foreach ($knowledgeList as $key => $value) {
            $result[$key] = KnowledgeModel::createFromRecord($value);
            $result[$key]->setChildrenCount($this->countChildren($result[$key]->getKnowledgeId()));

            // convert to array
            $result[$key] = $result[$key]->toArray();
        }

        return $result;
    }

    public function getAllParentBySubjectCode(int $subjectCode) : array {
        $result = [];
        $knowledgeList = DB::table('favorite_app__knowledge')
            ->where('subject_code', $subjectCode)
            ->where('parent_knowledge_code', 0)
            ->select(
                'knowledge_id',
                'title',
                'content',
                'citation_source',
                'same_level_sequence',
                'parent_knowledge_code',
                'subject_code',
                'picture',
                'is_important',
                'border_color',
                'is_favourite',
                'size_picture',
                'tree_level'
            )->get()->toArray();

        if (empty($knowledgeList)) {
            return [];
        }

        foreach ($knowledgeList as $key => $value) {
            $result[$key] = KnowledgeModel::createFromRecord($value);
            $result[$key]->setChildrenCount($this->countChildren($result[$key]->getKnowledgeId()));

            // convert to array
            $result[$key] = $result[$key]->toArray();
        }

//        dd($result);

        return $result;
    }

    public function getChildrenByParentKnowledgeCode($parentKnowledgeCode) : array {
        $result = [];
        $children = DB::table('favorite_app__knowledge')
            ->where('parent_knowledge_code', $parentKnowledgeCode)
            ->select(
                'knowledge_id',
                'title',
                'content',
                'citation_source',
                'same_level_sequence',
                'parent_knowledge_code',
                'subject_code',
                'picture',
                'is_important',
                'border_color',
                'is_favourite',
                'size_picture',
                'tree_level'
            )->get()->toArray();

        if (empty($children)) {
            return [];
        }

        foreach ($children as $key => $value) {
            $result[$key] = KnowledgeModel::createFromRecord($value);
            $result[$key]->setChildrenCount($this->countChildren($result[$key]->getKnowledgeId()));

            // convert to array
            $result[$key] = $result[$key]->toArray();
        }

        return $result;
    }

    public function countChildren(int $knowledgeId) {
        return DB::table('favorite_app__knowledge')
                    ->where('parent_knowledge_code', '=', $knowledgeId)
                    ->count();
    }

    public function add(KnowledgeUpdateParam $param) {

        $result = KnowledgeEntity::create([
            'title' => $param->getTitle(),
            'content' => $param->getContent(),
            'citation_source' => '', //$knowledge->getCitationSource(),
            'same_level_sequence' => $param->getSameLevelSequence(),
            'parent_knowledge_code' => $param->getParentKnowledgeCode(),
            'subject_code' => 0, //$knowledge->getSubjectCode(),
            'picture' => '',//$knowledge->getPicture(),
            'is_important' => 0,//$knowledge->isImportant(),
            'border_color' => '',//$knowledge->getBorderColor(),
            'is_favourite' => 0,//$knowledge->isFavourite(),
            'size_picture' => '',//$knowledge->getSizePicture(),
            'tree_level' => $param->getTreeLevel()
        ]);

        $returnData = $this->getById($result['knowledge_id']);

        return $returnData;
    }
}

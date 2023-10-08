<?php

use App\Http\Controllers\Base\KnowledgeArticleMaster\MasterSearch\MasterSearchBaseController;
use App\Http\Controllers\Master\FavoriteApp\Book\BookDetailController;
use App\Http\Controllers\Master\FavoriteApp\Book\BookListController;
use App\Http\Controllers\Master\FavoriteApp\Knowledge\KnowledgeController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle\KnowledgeArticleDetailController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticle\KnowledgeArticleListController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\KnowledgeArticleContentUnitDetailController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\KnowledgeArticleContentUnit\KnowledgeArticleContentUnitListController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\MasterSearch\MasterSearchController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Subject\SubjectDetailController;
use App\Http\Controllers\Master\KnowledgeArticleMaster\Subject\SubjectListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [App\Http\Controllers\Common\Authentication\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Common\Authentication\AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/master/favorite_app/knowledge/{id}', [KnowledgeController::class, 'getById']);

Route::post('/master/favorite_app/knowledge/add', [KnowledgeController::class, 'save']);

Route::get('/master/favorite_app/knowledge/list_by_subject/{subjectCode}', [KnowledgeController::class, 'getAllParentBySubjectCode']);
//Route::get('/master/favorite_app/knowledge/list_by_subject/{subjectCode}', [KnowledgeController::class, 'getAll']);

Route::get('/master/favorite_app/knowledge/list_by_parent_knowledge_code/{parentKnowledgeCode}', [KnowledgeController::class, 'getChildrenByParentKnowledgeCode']);

Route::group(
    ['middleware' => 'auth:api'], function () {
    Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);

        // route này dùng cho mode edit, add và detail luôn, mode add và edit thì có lấy thêm thông tin liên quan
    Route::get('/master/favorite_app/book/detail', [BookDetailController::class, 'initDisplay']);

        // route này sử dụng khi người dùng đang view book và muốn refresh để la6y1tho6ng tin mới nhất
//    Route::get('/master/favorite_app/book/detail/getDetail',);

        // route này chỉ lấy thông tin chung phản hồi từ backend, nhầm phát hiện lỗi cho phía client
        // vd: nếu không thấy phản hồi từ phía server tức là lỗi server hoặc lỗi network,...
//    Route::get('/master/favorite_app/book/detail/getCommonInfo',);


//    Route::post('/master/favorite_app/book/detail/validate',);
    Route::post('/master/favorite_app/book/detail/register', [BookDetailController::class, 'register']);
    Route::post('/master/favorite_app/book/detail/update', [BookDetailController::class, 'update']);
//    Route::get('/master/favorite_app/book/detail/reset',);
});

//Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);

//Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);

Route::group(
    ['middleware' => 'auth:api'], function () {
        // Màn hình List Root Subject
        Route::get('/master/knowledge_article_master/subject/list', [SubjectListController::class, 'initDisplay']);

        // Màn hình chi Detail Subject (1) và danh sách các bài viết của Branch Subject
        // + kèm theo danh sách các Subject là con của Subject (1)
        Route::get('/master/knowledge_article_master/subject/detail', [SubjectDetailController::class, 'initDisplay']);

        Route::post('/master/knowledge_article_master/subject/detail/register', [SubjectDetailController::class, 'register']);
        Route::post('/master/knowledge_article_master/subject/detail/update', [SubjectDetailController::class, 'update']);

        Route::get('/master/knowledge_article_master/master_search', [MasterSearchController::class, 'search']);


        Route::get('/master/knowledge_article_master/knowledge_article/list', [KnowledgeArticleListController::class, 'initDisplay']);
        Route::get('/master/knowledge_article_master/knowledge_article/detail', [KnowledgeArticleDetailController::class, 'initDisplay']);
        Route::post('/master/knowledge_article_master/knowledge_article/register', [KnowledgeArticleDetailController::class, 'register']);
        Route::post('/master/knowledge_article_master/knowledge_article/update', [KnowledgeArticleDetailController::class, 'update']);

        Route::get('/master/knowledge_article_master/knowledge_article_content_unit/list', [KnowledgeArticleContentUnitListController::class, 'initDisplay']);
        Route::get('/master/knowledge_article_master/knowledge_article_content_unit/detail', [KnowledgeArticleContentUnitDetailController::class, 'initDisplay']);
        Route::post('/master/knowledge_article_master/knowledge_article_content_unit/register', [KnowledgeArticleContentUnitDetailController::class, 'register']);
        Route::post('/master/knowledge_article_master/knowledge_article_content_unit/update', [KnowledgeArticleContentUnitDetailController::class, 'update']);
    }
);

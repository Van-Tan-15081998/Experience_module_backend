<?php

use App\Http\Controllers\Master\FavoriteApp\Book\BookDetailController;
use App\Http\Controllers\Master\FavoriteApp\Book\BookListController;
use App\Http\Controllers\Master\FavoriteApp\Knowledge\KnowledgeController;
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
//    Route::post('/master/favorite_app/book/detail/update',);
//    Route::get('/master/favorite_app/book/detail/reset',);
});

//Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);

//Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);


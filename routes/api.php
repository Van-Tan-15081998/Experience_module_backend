<?php

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
});

//Route::get('/master/favorite_app/book/list', [BookListController::class, 'initDisplay']);


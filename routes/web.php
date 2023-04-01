<?php

use App\Http\Controllers\Master\FavoriteApp\Knowledge\KnowledgeController;
use App\Http\Controllers\Master\LaravelResearch\EloquentORM\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/laravel_research/{id}', [EmployeeController::class, 'getById']);


Route::get('/master/favorite_app/knowledge/{id}', [KnowledgeController::class, 'getById']);

Route::get('/master/favorite_app/knowledge/list_by_subject/{subjectCode}', [KnowledgeController::class, 'getAllParentBySubjectCode']);

Route::get('/master/favorite_app/knowledge/list_by_parent_knowledge_code/{parentKnowledgeCode}', [KnowledgeController::class, 'getChildrenByParentKnowledgeCode']);

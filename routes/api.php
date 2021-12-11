<?php

use App\Http\Controllers\API\Articles\ArticlesController;
use App\Http\Controllers\API\Articles\ArticlesSearchController;
use App\Http\Controllers\API\Articles\ArticlesTrashedController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('articles', ArticlesController::class)->except(['index', 'show']);
});

Route::get('articles/search', ArticlesSearchController::class)->name('articles.search');
Route::get('articles/trashed', ArticlesTrashedController::class)->name('articles.trashed');
Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('articles/{article:slug}', [ArticlesController::class, 'show'])->name('articles.show');

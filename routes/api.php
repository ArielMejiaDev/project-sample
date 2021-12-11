<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\ArticleSearchController;
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

require_once('auth.php');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('articles', ArticleController::class)->except(['index', 'show']);
});

Route::get('articles/search', ArticleSearchController::class)->name('articles.search');
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('contents', App\Http\Controllers\ContentController::class);
Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
Route::apiResource('likes', App\Http\Controllers\LikeController::class);
// Route::get('like/user/{id_user}/content/{id_content}', LikeController::seeLikeContentUser);

Route::controller(LikeController::class)->group(function () {
    Route::get('like/{id_user}/content/{id_content}', 'seeLikeContentUser');
    Route::get('like/content/{id_content}', 'totalContentLike');
    Route::get('like-user/{id_user}', 'seeContentLikeUser');
    });
Route::controller(ContentController::class)->group(function () {
    Route::get('search/{title_search}', 'search');
    });
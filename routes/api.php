<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Authenticated API routes
Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum', /*'2fa'*/]],
    function () {

        Route::post('logout', [LoginController::class, 'logout'])->name('user.logout');

        Route::get('user', function (Request $request) {
            return $request->user();
        })->name('user.me');

        Route::get('article', [ArticleController::class, 'index']);
        Route::get('article/{article}', [ArticleController::class, 'show']);
        Route::post('article', [ArticleController::class, 'store']);
        Route::put('article/{article}', [ArticleController::class, 'update']);
        Route::delete('article/{article}', [ArticleController::class, 'delete']);
    }
);


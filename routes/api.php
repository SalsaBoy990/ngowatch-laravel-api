<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VerificationController;
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
Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum', 'verified'/*'2fa'*/]],
    function () {
        /* Auth */
        Route::get('user', [AuthController::class, 'user'])->name('auth.user');
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
        /* Auth END */


        /* Articles */
        Route::get('article', [ArticleController::class, 'index']);
        Route::get('article/{article}', [ArticleController::class, 'show']);
        Route::post('article', [ArticleController::class, 'store']);
        Route::put('article/{article}', [ArticleController::class, 'update']);
        Route::delete('article/{article}', [ArticleController::class, 'delete']);
        /* Articles END */
    }
);
// Authenticated API routes END

Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function() {
    Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

});


// Public API routes
Route::group(['prefix' => 'v1'],
    function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('register', [AuthController::class, 'register'])->name('auth.register');

        Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');

    }
);
// Public API routes END


<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/**
 * This is the frontpage route
 */
Route::get('/', function () {
    return view('pages.public.frontpage');
})->name('frontpage');


/**
 * Public routes go here
 */
Route::group([],
    function () {

        Route::post('login', [LoginController::class, 'login2'])->name('user.login2');

    });


Auth::routes([
    'logout' => false
]);


Route::group(
    ['middleware' => ['auth', 'verified', 'role:super-administrator|administrator|editor']],
    function () {

        /* 2FA endpoints */
        Route::get('2fa', [UserCodeController::class, 'index'])->name('2fa.index');
        Route::post('2fa', [UserCodeController::class, 'store'])->name('2fa.post');
        /* 2FA endpoints END */
        Route::get('2fa/reset', [UserCodeController::class, 'resend'])->name('2fa.resend');

    }
);


/**
 * This is the SPA-route
 */
Route::group(
    ['middleware' => ['auth', 'verified', '2fa', 'role:super-administrator|administrator']],
    function () {

        Route::get('/admin/app', function () {
            return view('pages.admin.admin');
        })->name('spa');

    });


Route::group(
    ['middleware' => ['auth', 'verified', '2fa', 'role:super-administrator|administrator|editor'], 'prefix' => 'admin'],
    function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


        /* Users/Account */
        Route::get('user/account/{user}', [UserController::class, 'account'])->name('user.account');
        Route::put('user/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('user/account/delete/{user}', [UserController::class, 'deleteAccount'])->name('user.account.delete');
        Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
        /* Users/Account END */

    }
);


Route::group(
    ['middleware' => ['auth', 'verified', '2fa', 'role:super-administrator'], 'prefix' => 'admin'],
    function () {

        Route::get('user/manage', [UserController::class, 'index'])->name('user.manage');
        Route::delete('user/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');


        /* Roles and Permissions */
        Route::get('role-permission/manage', [RolePermissionController::class, 'index'])->name('role-permission.manage');
        /* Roles and Permissions END */

    }
);


/**
 * This is for testing
 */
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
})->name('sentry');

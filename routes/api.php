<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ListApiController;
use App\Http\Controllers\Api\AuthApiController;

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

Route::post('/register', [AuthApiController::class, 'register'])
    ->name('register');

Route::post('/login', [AuthApiController::class, 'login'])
    ->name('login');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthApiController::class, 'logout'])
        ->name('logout');

    //todo нужны роуты и функционал delete, update
    //todo вынести роуты list в отдельный файл
    Route::post('/store_user', [ListApiController::class, 'storeUser'])
        ->name('store_user');

    Route::get('/get_users_list_from_db', [ListApiController::class, 'getUsersListFromDb'])
        ->name('get_users_list_from_db');

    Route::get('/get_users_list_from_cache', [ListApiController::class, 'getUsersListFromCache'])
        ->name('get_users_list_from_cache');

    Route::post('/import_users_from_xlsx_file', [ListApiController::class, 'importUsersFromXlsxFile'])
        ->name('import_users_from_xlsx_file');

    Route::get('/export_users_from_xlsx_file', [ListApiController::class, 'exportUsersFromXlsxFile'])
        ->name('export_users_from_xlsx_file');
});

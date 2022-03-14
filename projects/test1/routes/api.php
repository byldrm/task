<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\UserListController;
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

Route::controller(LoginController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/user_list',UserListController::class);
    Route::get('/api_list',[UserListController::class,'api_list']);
    Route::post('/get_users_from_api',[UserListController::class,'get_users_from_api']);
});


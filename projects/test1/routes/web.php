<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserListController;
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
//pull_users_from_api
Route::get('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('login',[LoginController::class,'login_post'])->name('login_post');

Route::middleware('checkaccesstoken')->group( function () {
    Route::get('/',[UserListController::class,'index'])->name('dashboard');
    Route::post('get_users_from_api',[UserListController::class,'get_users_from_api'])->name('get_users_from_api');
    Route::post('user_save',[UserListController::class,'user_save'])->name('user_save');
    Route::get('user_list',[UserListController::class,'user_list'])->name('user_list');
});

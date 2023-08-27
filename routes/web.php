<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TypeFormController;
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
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    // Route::get('home',function()
    // {
    //     return view('home');
    // });
    // Route::get('home',function()
    // {
    //     return view('home');
    // });
});

Auth::routes();

// -----------------------------login-------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// -------------------------- user management ----------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('user/list', 'index')->middleware('auth')->name('user/list');
    Route::get('user/getlist', 'list')->middleware('auth')->name('getlist');
    Route::post('user/fetch-states', 'fetchState')->middleware('auth');
    Route::post('user/store', 'storeUser')->name('user/store');
    Route::get('user/edit/{id}', 'edit')->middleware('auth')->name('user.edit');
    Route::get('user/view/{id}', 'view')->middleware('auth')->name('user.view');
    Route::get('user/changestatus/{id}', 'changeStatus')->middleware('auth')->name('user.changestatus');
    Route::post('user/update', 'updateRecord')->name('user/update');
    Route::post('user/delete', 'deleteRecord')->name('user/delete');
});


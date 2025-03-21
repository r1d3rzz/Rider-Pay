<?php

use Illuminate\Support\Facades\Auth;
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

//User Auth
Auth::routes();

//Admin Auth
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::middleware("auth")->namespace("Frontend")->group(function () {
    Route::get('/', 'PageController@index')->name("home");
    Route::get('/profile', 'PageController@profile')->name("profile");
    Route::get('/password_update', 'PageController@passwordUpdate')->name("password_update");
    Route::post('/password_update', 'PageController@updatePasswordUpdate')->name("update_password_update");
});

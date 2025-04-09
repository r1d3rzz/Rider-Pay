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

    Route::get('/wallet', 'PageController@userWallet')->name("wallet");

    Route::prefix("transfer")->group(function () {
        Route::get('/', 'PageController@transfer')->name("transfer");
        Route::post('confirm', 'PageController@transfer_confirm')->name("transfer.confirm");
        Route::post('continue', 'PageController@transfer_continue')->name("transfer.continue");

        Route::get("transactions", "PageController@transactions")->name("transfer.transactions");
        Route::get("transactions/{txn_id}", "PageController@transaction_detail")->name("transfer.transaction_detail");

        Route::get("receive_qr", "PageController@receive_qr")->name("transfer.receive_qr");

        Route::get('/phoneVerify', 'PageController@phoneVerify')->name("transfer.phoneVerify");
        Route::get('/passwordVerify', 'PageController@passwordVerify')->name("transfer.passwordVerify");
        Route::get('/makeTransaction', 'PageController@makeTransaction')->name("transfer.makeTransaction");
    });

    Route::prefix("notifications")->group(function () {
        Route::get("/", "NotificationController@index")->name("notifications");
        Route::get("/{id}", "NotificationController@show")->name("notifications.show");
    });
});

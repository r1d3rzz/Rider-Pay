<?php

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

Route::prefix("admin")->name("admin.")->namespace("Backend")->middleware("auth:admin_user")->group(function () {
    Route::get("/", "PageController@home")->name("home");

    Route::resource("admin-user", "AdminUserController");
    Route::get("admin-user/datatable/ssd", "AdminUserController@ssd");

    Route::resource("user", "UserController");
    Route::get("user/datatable/ssd", "UserController@ssd");


    Route::resource("/wallet", "WalletController")->only(["index"]);

    Route::prefix("wallet")->group(function () {
        Route::get('/amount/add', 'WalletController@addWalletAmount')->name("wallet.addAmount");
        Route::post('/amount/add', 'WalletController@addWalletAmountStore')->name("wallet.addAmount.post");
        Route::get('/amount/reduce', 'WalletController@reduceWalletAmount')->name("wallet.reduceAmount");
        Route::post('/amount/reduce', 'WalletController@reduceWalletAmountStore')->name("wallet.reduceAmount.post");
    });

    Route::get("wallet/datatable/ssd", "WalletController@ssd");
});

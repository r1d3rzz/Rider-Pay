<?php

use Illuminate\Http\Request;
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

Route::namespace("Api")->group(function () {
    Route::post("login", "AuthController@login");
    Route::post("register", "AuthController@register");

    Route::middleware('auth:api')->group(function () {
        Route::post("logout", "AuthController@logout");

        Route::get("profile", "PageController@profile");

        Route::prefix("transactions")->group(function () {
            Route::get("/", "PageController@transactions");
            Route::get("/{txn_id}", "PageController@transactionDetail");
        });
    });
});

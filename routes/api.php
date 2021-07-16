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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'callback'], function () {
    Route::match(['get', 'post'],'/collection', [App\Http\Controllers\BeemCallbackController::class, 'collection'])->name('api_beem_collection');
    Route::match(['get', 'post'],'/sms_delivery', [App\Http\Controllers\BeemCallbackController::class, 'sms_delivery'])->name('api_beem_sms_delivery');
});

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

Route::group(['prefix' => 'client'], function () {
    Auth::routes();
});
Route::group(['name' => 'Client', 'namespace' => 'App\Controller\Client', 'prefix' => 'client', 'middleware' => 'auth'], function () {
    Route::match(['get', 'post'],'/entreaties', [App\Http\Controllers\EntreatyController::class, 'mine'])->name('client_entreaties');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::match(['get', 'post'],'/create', [App\Http\Controllers\EntreatyController::class, 'create'])->name('create_entreaty');
Route::get('/e/{uid}', [App\Http\Controllers\EntreatyController::class, 'view'])->name('entreaty_view');
Route::get('/terms', [App\Http\Controllers\TermsPageController::class, 'index'])->name('terms');
Route::get('/about', [App\Http\Controllers\TermsPageController::class, 'about'])->name('about');




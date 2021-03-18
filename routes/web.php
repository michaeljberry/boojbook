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
| Test GPG Key
| Test GPG Key
*/
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('book/sort', [App\Http\Controllers\BookController::class, 'sort']);
Route::resource('book', App\Http\Controllers\BookController::class);
Route::get('user/api', [App\Http\Controllers\UserController::class, 'api_token']);

Route::post('api_docs/getyajra', [App\Http\Controllers\ApiDocController::class, 'getyajra']);
Route::resource('api_docs', \App\Http\Controllers\ApiDocController::class);
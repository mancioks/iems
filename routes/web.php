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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('entry/sync', [\App\Http\Controllers\EntryController::class, 'sync'])->name('entry.sync');
    Route::get('entry/create/{type}', [\App\Http\Controllers\EntryController::class, 'create'])->name('entry.create');
    Route::resource('entry', \App\Http\Controllers\EntryController::class);
    Route::resource('website', \App\Http\Controllers\WebsiteController::class);
    Route::resource('language', \App\Http\Controllers\LanguageController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
});

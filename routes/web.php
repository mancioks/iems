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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('entry/sync', [\App\Http\Controllers\EntryController::class, 'sync'])->name('entry.sync');
Route::resource('entry', \App\Http\Controllers\EntryController::class);
Route::resource('website', \App\Http\Controllers\WebsiteController::class);

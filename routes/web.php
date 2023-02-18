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

//Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->middleware('guest');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
Route::get('/admin/test/create', [App\Http\Controllers\Admin\TestController::class, 'index'])->name('test.index');
Route::post('/admin/test/create', [App\Http\Controllers\Admin\TestController::class, 'create'])->name('test.create');

Route::get('/admin/test/{test}/questions', [App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('test.question.create');
Route::post('/admin/test/{test}/questions/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('test.create.question');

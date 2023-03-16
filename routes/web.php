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
Route::get('/tests/categories', [App\Http\Controllers\TestController::class, 'index'])->name('tests.index');
Route::get('/tests/categories/{category}', [App\Http\Controllers\TestController::class, 'testCategories'])->name('tests.category');
Route::get('/tests/categories/{category}/show/{key}', [App\Http\Controllers\TestController::class, 'testShow'])->name('test.show');
Route::post('/test/{key}/get-questions', [App\Http\Controllers\TestController::class, 'testGetQuestions']);
Route::post('/test/{key}/send-question', [App\Http\Controllers\TestController::class, 'testSendQuestions']);
Route::post('/test/{key}/complete-test', [App\Http\Controllers\TestController::class, 'testCompleted']);
Route::get('/test/{key}/last-question/{question}', [App\Http\Controllers\TestController::class, 'lastQuestion']);
Route::post('/test/{key}/paired-test/{pairedTestKey}', [App\Http\Controllers\TestController::class, 'pairedTestKey']);

Route::get('/test/paired-test', [App\Http\Controllers\TestController::class, 'pairedTest'])->name('test.paired_test');

Route::get('/test/{key}/results/{passedTest}', [App\Http\Controllers\ResultTestController::class, 'test'])->name('results.test');
Route::get('/test/results', [App\Http\Controllers\ResultTestController::class, 'test'])->name('results.test');

Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
Route::get('/admin/test/category-create', [App\Http\Controllers\Admin\TestController::class, 'createCategoryIndex']);
Route::post('/admin/test/category-create', [App\Http\Controllers\Admin\TestController::class, 'createCategory']);
Route::get('/admin/test/create', [App\Http\Controllers\Admin\TestController::class, 'index'])->name('test.index');
Route::post('/admin/test/create', [App\Http\Controllers\Admin\TestController::class, 'create'])->name('test.create');


Route::get('/admin/test/{test}/questions', [App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('test.question.create');
Route::post('/admin/test/{test}/questions/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('test.create.question');

<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('admin/login', 'login_view')->name('admin.login');
    Route::post('admin/login', 'login');

    Route::post('admin/logout', 'logout')->name('admin.logout');
});

Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::controller(SubjectController::class)->group(function () {
    Route::get('admin/subjects', 'index')->name('admin.subjects');
    Route::get('admin/subject/create', 'create')->name('admin.subject.create');
    Route::post('admin/subject/create', 'store');
    Route::get('admin/subject/{subject}/edit', 'edit')->name('admin.subject.edit');
    Route::post('admin/subject/{subject}/edit', 'update');
    Route::post('admin/subject/{subject}/destroy', 'destroy')->name('admin.subject.delete');
});


Route::controller(TopicController::class)->group(function () {
    Route::get('admin/topics', 'index')->name('admin.topics');
    Route::get('admin/topic/create', 'create')->name('admin.topic.create');
    Route::post('admin/topic/create', 'store');
    Route::get('admin/topic/{topic}/edit', 'edit')->name('admin.topic.edit');
    Route::post('admin/topic/{topic}/edit', 'update');
    Route::post('admin/topic/{topic}/destroy', 'destroy')->name('admin.topic.delete');
});

Route::get('admin/questions', [QuestionController::class, 'index'])->name('admin.questions');
Route::get('admin/question/create', [QuestionController::class, 'create'])->name('admin.question.create');

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

Route::get('admin/login', [AuthController::class, 'login_view'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login']);

Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('admin/subjects', [SubjectController::class, 'index'])->name('admin.subjects');
Route::get('admin/subject/create', [SubjectController::class, 'create'])->name('admin.subject.create');
Route::post('admin/subject/create', [SubjectController::class, 'store']);

Route::get('admin/topics', [TopicController::class, 'index'])->name('admin.topics');

Route::get('admin/questions', [QuestionController::class, 'index'])->name('admin.questions');
Route::get('admin/question/create', [QuestionController::class, 'create'])->name('admin.question.create');



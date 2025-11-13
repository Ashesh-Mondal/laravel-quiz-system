<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/admin-login', 'admin-login');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware('CheckAdminAuth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin-categories', [AdminController::class, 'categories'])->name('admin.categories');

    Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/add-category', [AdminController::class, 'addCategory'])->name('add.category');

    Route::get('/{id}/delete-category', [AdminController::class, 'deleteCategory'])->name('delete.category');

    Route::get('/add-quiz', [AdminController::class, 'addQuiz'])->name('add.quiz');
    Route::post('/add-mcqs', [AdminController::class, 'addMCQs'])->name('add.mcqs');

    Route::get('/exit-mcqs', [AdminController::class, 'exitMCQs'])->name('exit.mcqs');
    Route::get('/show-quiz/{id}/{name}', [AdminController::class, 'showQuiz'])->name('show.quiz');
    Route::get('/quiz-list/{id}/{name}', [AdminController::class, 'quizList'])->name('quiz.list');
});


Route::get('/', [UserController::class, 'welcome']);
Route::get('/user-quiz-list/{id}', [UserController::class, 'userQuizList'])->name('show.quiz.list');
Route::view('/user-signup', 'user-signup');
Route::post('/user-signup', [UserController::class, 'userSignup'])->name('user.signup');
Route::get('/start-quiz/{id}', [UserController::class, 'startQuiz'])->name('start.quiz');
Route::get('/logout-user', [UserController::class, 'logoutUser'])->name('logout.user');
Route::get('/user-signup-quiz', [UserController::class, 'userSignupQuiz'])->name('user.signup.quiz');
Route::view('/user-login', 'user-login');
Route::post('/user-login', [UserController::class, 'userLogin'])->name('user.login');
Route::get('/user-login-quiz', [UserController::class, 'userLoginQuiz'])->name('user.login.quiz');

Route::middleware('CheckUserAuth')->group(function () {
    Route::get('/mcq/{id}/{name}', [UserController::class, 'mcq'])->name('mcq.page');
    Route::post('/submit-next/{id}', [UserController::class, 'submitAndNext'])->name('submit.and.next');
    Route::get('/user-details', [UserController::class, 'userDetails'])->name('user.details');
});

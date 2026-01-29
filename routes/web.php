<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AuthController;

// 1. This is HOME route
Route::get('/', function () {
    if (auth()->check()) { return redirect()->route('forum.index'); }
    return view('welcome');
})->name('home');

// 2. This is AUTH route
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/account/delete', [AuthController::class, 'showDeleteConfirm'])->name('account.confirm')->middleware('auth');


Route::delete('/account/delete', [AuthController::class, 'deleteAccount'])->name('account.destroy')->middleware('auth');

// 3. This is the FORUM route
Route::middleware('auth')->group(function () {
    // For Questions
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/ask', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/ask', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/question/{id}', [ForumController::class, 'show'])->name('forum.show');
    Route::get('/question/{id}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/question/{id}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/question/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');

    // For Answers
    Route::post('/question/{id}/answer', [ForumController::class, 'storeAnswer'])->name('answers.store');
    Route::delete('/answer/{id}', [ForumController::class, 'destroyAnswer'])->name('answers.destroy');


    Route::get('/answer/{id}/edit', [ForumController::class, 'editAnswer'])->name('answers.edit');
    Route::put('/answer/{id}', [ForumController::class, 'updateAnswer'])->name('answers.update');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

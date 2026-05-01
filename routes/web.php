<?php

use App\Http\Controllers\Auth\QuizRaceLoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [QuizRaceLoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [QuizRaceLoginController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [QuizRaceLoginController::class, 'logout'])
    ->name('logout');

Route::middleware('quizrace.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});
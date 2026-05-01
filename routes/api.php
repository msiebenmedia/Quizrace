<?php

use App\Http\Controllers\Auth\MentixAuthController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [MentixAuthController::class, 'login']);
Route::get('/auth/me', [MentixAuthController::class, 'me']);
Route::post('/auth/logout', [MentixAuthController::class, 'logout']);
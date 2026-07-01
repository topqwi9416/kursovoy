<?php
// routes/web.php — маршруты аутентификации

use App\Http\Controllers\AuthController;

// Регистрация
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Вход
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Личный кабинет — защищён middleware auth
Route::get('/profile', [AuthController::class, 'profile'])
    ->name('profile')
    ->middleware('auth');
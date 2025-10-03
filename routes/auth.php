<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'show'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/forget-password', [ForgetPasswordController::class, 'show'])->name('auth.forget-password');
Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPassword']);

Route::get('/reset-password', [ResetPasswordController::class, 'show'])->name('auth.reset-password');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

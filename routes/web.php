<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/note', NoteController::class)->names('note');

Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{user}', [UserProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/edit', [UserProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/edit/upload', [UserProfileController::class, 'updateImage'])->name('profile.update-image');


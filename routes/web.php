<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/note', NoteController::class)->names('note');
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', function () {
    $request = request()->validate([
        'email' => ['required'],
    ]);
    return redirect()->to('/note')->with('message', 'Login successful');
});
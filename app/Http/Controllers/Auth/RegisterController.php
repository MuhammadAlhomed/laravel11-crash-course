<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Storage;

class RegisterController extends Controller
{
    public function show ()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = request()->validate([
            'username' => ['required','string', 'unique:users'],
            'name' => ['required', 'string', 'max:32'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8' , 'confirmed'] // will be automatically hashed
        ]);

        // Give a default profile picture to user
        $validated += ['avatar' => Storage::disk('public')->putFile('avatar',new File(storage_path('app/placeholders/profile_pic.png')))];

        // Create User
        $user = User::create($validated);

        // Login
        Auth::login($user, $request->filled('remember'));

        return redirect()->to('/note')->with('message', 'Registered successfully');
    }
}

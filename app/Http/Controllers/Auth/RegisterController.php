<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8' , 'confirmed'] // will be automatically hashed
        ]);

        // Create User
        $user = User::create($validated);

        // Login
        Auth::login($user, $request->filled('remember'));

        return redirect()->to('/note')->with('message', 'Registered successfully');
    }
}

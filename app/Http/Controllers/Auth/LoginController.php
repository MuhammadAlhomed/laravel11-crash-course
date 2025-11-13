<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        // Attempt to Login
        if(!Auth::attempt($validated, $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'The email or password is wrong'
            ]);
        }

        // Regenerate Session Token
        request()->session()->regenerate();

        return redirect()->to('/note')->with('message', 'Login successful');
    }
    public function logout() {

        Auth::logout();

        return redirect()->to('/note')->with('message', 'Logout successful');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login()
    {
        $request = request()->validate([
            'email' => ['required'],
        ]);

        return redirect()->to('/note')->with('message', 'Login successful');
    }
}

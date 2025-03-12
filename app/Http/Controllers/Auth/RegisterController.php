<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show ()
    {
        return view('auth.register');
    }
    public function register()
    {
        $request = request()->validate([
            'email' => ['required'],
        ]);

        return redirect()->to('/note')->with('message', 'Registered successfully');
    }
}

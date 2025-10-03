<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ForgetPasswordController extends Controller
{
    public function show(Request $request)
    {
        if($request->query('token')){
            $resetToken = DB::table('password_reset_tokens')->find($request->query('token'));
            if(!$resetToken)
                abort(403);

            return view('auth.forget-password-sent', ['resetToken' => $resetToken]);
        }

        return view('auth.forget-password');
    }

    public function forgetPassword(Request $request)
    {
        session()->regenerateToken();

        $validated = request()->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        DB::table('password_reset_tokens')->updateOrInsert(
            [
            'email' => $validated['email']
            ],
            [
            'id' => Str::random(16),
            'email' => $validated['email'],
            'token' => Str::random(32),
            'created_at' => now(),
            'expired_at' => now()->addMinutes(30)
            ]);

        $resetToken  = DB::table('password_reset_tokens')->where('email', '=', $validated['email'])->first();

        return redirect()->to(route('auth.forget-password', ['token' => $resetToken->id]));
    }
}

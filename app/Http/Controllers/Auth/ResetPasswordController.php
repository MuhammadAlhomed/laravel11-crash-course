<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function show(Request $request)
    {
        $resetToken = DB::table('password_reset_tokens')->where('token', $request->query('token'))->first();

        if(!$resetToken || Carbon::parse($resetToken->expired_at)->isPast())
            abort(403);

        return view('auth.reset-password', ['resetToken' => $resetToken]);
    }
    public function resetPassword(Request $request)
    {
        $validated = request()->validate([
            'password' => ['required', 'string', 'min:8' , 'confirmed']
        ]);

        $resetToken = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if(!$resetToken || Carbon::parse($resetToken->expired_at)->isPast())
            abort(403);

        $user = User::whereEmail($resetToken->email)->first();

        # If the password is the same as old password
        if(Hash::check($validated['password'], $user->password)){
            return back()->withErrors(['password' => 'The new password cannot be the same as the old password']);
        }

        $user->update([
            'password' => $request->password
        ]);

        session()->regenerateToken();

        return redirect()->to(route('auth.login'))->with('message', 'The password has been reset successfully');
    }
}

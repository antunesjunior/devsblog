<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function reset($token)
    {
        return view('reset-password', ['token' => $token]); 
    }

    public function update(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:5', 'confirmed']
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->fill(['password' => Hash::make($password)])
                     ->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('alert', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}

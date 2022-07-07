<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function verifyEmail()
    {
        $user = Auth::user();
        return view('auth.verify-email', ['user' => $user]);
    }

    public function verifyEmailSend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice');
    }

    public function confirmEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('auth.home');
    }

}

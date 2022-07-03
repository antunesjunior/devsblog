<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function signin()
    {
        return view('sign-in');
    }

    public function auth(Request $request)
    {
        $validate =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validate, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('auth/home');
        }

        return back()->with('alert', 'Email ou senha inválida, verifique os dados!');
    }
}

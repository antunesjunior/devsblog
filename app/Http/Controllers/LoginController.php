<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validate =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validate, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        
        return back()->with('alert', 'Email ou senha inválida, verifique os dados!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/login');
    }
}

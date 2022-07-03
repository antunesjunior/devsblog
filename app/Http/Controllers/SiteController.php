<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SiteController extends Controller
{
    public function login()
    {
        return view('sign-in');
    }

    public function register()
    {
        return view('sign-up');
    }

    public function createUser(Request $request)
    {
        $validate = $request->validate([
            'first_name'     => ['required'],
            'last_name'      => ['required'],
            'email'          => ['required', 'email', 'unique:users'],
            'password'       => ['required', 'confirmed', Password::min(5)],
        ]);

        $validate['password'] = Hash::make($request->input('password'));

        Auth::login(User::create($validate));

        return redirect()->route('auth.home', ['user' => Auth::user()]);
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
}

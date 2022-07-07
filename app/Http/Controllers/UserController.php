<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'first_name'     => ['required'],
            'last_name'      => ['required'],
            'email'          => ['required', 'email', 'unique:users'],
            'password'       => ['required', 'confirmed', 'min:5'],
        ]);

        $validate['password'] = Hash::make($request->input('password'));
        $user = User::create($validate);

        Auth::login($user);
        event(new Registered($user));
        return redirect()->route('verification.notice');
    }

    

   

    

    public function edit($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.profile-edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'bio'        => ['nullable'],
            'company'    => ['nullable'],
            'web'        => ['nullable'],
            'city'       => ['nullable','min:3'],
            'picture'    => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('picture')) 
        {
            $image = $request->file('picture');
            $storagePath = 'public/avatars';
            $imageName = $image->hashName();
            $image->storeAs($storagePath, $imageName);

            if (auth()->user()->picture) {
                Storage::delete($storagePath.'/'.auth()->user()->picture);
            }

            $validate['picture'] = $imageName;
        }
        auth()->user()->fill($validate)->save();
        
        return redirect()->route('profile', ['user' => auth()->user()]);
    }


    public function destroy($id)
    {
        //
    }
}

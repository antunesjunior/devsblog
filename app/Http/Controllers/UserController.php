<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(StoreUserRequest $request)
    {
        $input = $request->validated();

        $input['password'] = Hash::make($request->input('password'));
        $user = User::create($input);

        Auth::login($user);
        event(new Registered($user));
        return redirect()->route('verification.notice');
    }

    public function show($username)
    {
        $user = User::getByUsername($username);

        return view('auth.profile', [
            'user'  => $user,
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.profile-edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $username)
    {
        $input = $request->validated();

        $newUsername = $request->get('username');
        $user = User::getByUsername($username);

        if (!isset($user)) {
            abort(404);
        }

        $this->authorize('update', $user);

        if (Auth::user()->username != $newUsername) {
            if (User::checkUsername($newUsername, $user->id)) {
                return redirect()->back()->with('message', 'Este username já existe, não pode ser usado');
            }
            $input['username'] = UserHelper::generateUserName($newUsername);
        }

        if ($request->hasFile('picture')) 
        {
            $image = $request->file('picture');
            $storagePath = 'public/avatars';
            $imageName = $image->hashName();
            $image->storeAs($storagePath, $imageName);

            if (Auth::user()->picture) {
                Storage::delete($storagePath.'/'.auth()->user()->picture);
            }

            $input['picture'] = $imageName;
        }
        
        Auth::user()->fill($input)->save();
        return redirect()->route('user.show', ['username' => $input['username']]);
    }
}

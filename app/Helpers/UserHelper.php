<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class UserHelper
{
    public static function generateUserName($username)
    {
        $username = Str::slug($username, '');
        if (User::where('username', $username)->exists()){
            $uniqueUserName = $username.rand(1, 1000);
            $username = self::generateUserName($uniqueUserName);
        }
        return $username;
    }
}
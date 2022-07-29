<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Str;

class UserHelper
{
    public static function generateUserName($name)
    {
        $username = '@'.Str::lower($name);

        if(User::where('username', '=', $username)->exists()){
            $uniqueUserName = $username.rand();
            $username = self::generateUserName($uniqueUserName);
        }
        return $username;
    }
}
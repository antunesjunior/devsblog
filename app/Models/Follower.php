<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'following_id'];

    public static function isFollowed($authId, $followId)
    {
       return self::where('user_id', $authId)->where('following_id', $followId)->exists();
    }
}

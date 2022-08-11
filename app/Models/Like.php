<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public static function isLiked(int $postId): bool
    {
        return self::where('user_id', Auth::id())->where('post_id', $postId)->exists();
    }

    public static function getAuthUserLike(int $postId)
    {
        return Auth::user()->like()->where('post_id', $postId)->first();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'uri',
        'views',
        'description',
        'cover',
        'content',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getByUserAndStatus(User $user, string $status)
    {
        return $user->posts()->where('status', $status)->orderBy('id', 'DESC')->get();
    }

    public static function getPostsForyou()
    {
        $posts = Post::where('user_id', '!=', Auth::id())->where('status', 'posted');
        return $posts;
    }

    public static function getPostsFollow()
    {
        $posts = self::rightJoin('followers', 'posts.user_id', '=', 'followers.following_id')
                        ->where('followers.user_id', Auth::id())
                        ->where('posts.status', 'posted')
                        ->orderby('posts.created_at', 'desc')
                        ->get();

        return $posts;
    }
}

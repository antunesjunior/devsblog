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

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function getByUserAndStatus(User $user, string $status)
    {
        return $user->posts()->where('status', $status)->orderBy('id', 'DESC')->get();
    }

    public static function getPostsForyou()
    {
        $posts = Post::where('user_id', '!=', Auth::id())
                ->where('status', 'posted')
                ->orderby('created_at', 'desc')
                ->get();
        return $posts;
    }

    public static function getPostsFollow()
    {
        $posts = self::select(
            'posts.id',
            'title',
            'uri',
            'description',
            'views',
            'cover',
            'content',
            'posts.user_id',
            'posts.created_at',
            'posts.updated_at'
            )
            ->rightJoin('followers', 'posts.user_id', '=', 'followers.following_id')
            ->where('followers.user_id', Auth::id())
            ->where('posts.status', 'posted')
            ->orderby('posts.created_at', 'desc')
            ->get();

        return $posts;
    }
}

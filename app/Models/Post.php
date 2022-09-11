<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'uri',
        'views',
        'description',
        'cover',
        'content',
        'is_draft',
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function getBySlugOrFail($slug)
    {
        $post = self::where('uri', $slug)->first();
        if (!isset($post)) {
            abort(404);
        }
        
        return $post;
    }

    public static function getPostsForyou()
    {
        $posts = Post::where('user_id', '!=', Auth::id())
                ->where('is_draft', '0')
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
            ->where('posts.is_draft', '0')
            ->orderby('posts.created_at', 'desc')
            ->get();

        return $posts;
    }
}

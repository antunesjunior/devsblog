<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function postsForYou()
    {
        $posts = Post::getPostsForyou();
        return view('auth.posts-feed', [
            'title' => 'Artigos para você',
            'posts' => $posts
        ]);
    }

    public function postsFollow()
    {
        $postsFollow = Post::getPostsFollow();
        //return response()->json($postsFollow);
        return view('auth.posts-feed', [
            'title' => 'Artigos seguidos',
            'posts' => $postsFollow
        ]);
    }
}

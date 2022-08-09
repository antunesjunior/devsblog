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
        return response()->json($posts);
    }

    public function postsFollow()
    {
        $postsFollow = Post::getPostsFollow();
        return response()->json($postsFollow);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postSlag)
    {
        $post = Post::where('uri', $postSlag)->first();
        
        if (!isset($post)) {
            abort(404);
        }

        $comments = $post->comments()->orderby('created_at')->get();

        return view('auth.comments', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($postSlag)
    {
        return view('auth.comments-create',[
            'slag' => $postSlag
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postSlag)
    {
        $data = $request->validate([
            'content' => ['required', 'string']
        ]);

        $post = Post::where('uri', $postSlag)->first();
        
        if (!isset($post)) {
            abort(404);
        }
        
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $data['content']
        ]);

        return redirect()->route('posts.comments.index', $post->uri);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($postSlag)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

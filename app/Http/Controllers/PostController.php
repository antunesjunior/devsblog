<?php

namespace App\Http\Controllers;

use App\Helpers\PostHelper;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', 'posted');
        return response()->json($posts);
    }

    public function published($username)
    {
        $user = User::getByUsername($username);
        if (!isset($user)) {
            abort(404);
        }

        $posts = (new Post())->getByUserAndStatus($user, 'posted');
        //return response()->json($posts);
        return view('auth.posts-user', [
            'title' => 'Artigos Publicados',
            'posts' => $posts
        ]);
    }

    public function drafts($username)
    {
        $user = User::getByUsername($username);
        if (!isset($user)) {
            abort(404);
        }

        $this->authorize('viewDrafts', $user);
        $posts = (new Post())->getByUserAndStatus($user, 'draft');

        //return response()->json($posts);
        return view('auth.posts-user', [
            'title' => 'Artigos em Rascunho',
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.post-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $postData = $request->validated();
        
        $postData['uri']     = PostHelper::generateSlug($request->input('title'));
        $postData['cover']   = PostHelper::UploadCover($request->file('cover'));
        $postData['user_id'] = Auth::id();

        $request->has('draft') ? $postData['status'] = 'draft' : '';
    
        Post::create($postData);
        return back()->with('message', 'Sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::getBySlug($slug);

        if (!isset($post)) {
            abort(404);
        }

        return view('auth.post', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postData = Post::find($id);
        return view('auth.post-edit', ['post' => $postData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $input = $request->validated();

        $post = Post::find($id);

        if ($request->hasFile('cover')) {
            $input['cover'] = PostHelper::UpdateCover($request->cover, $post->cover);
        }
        $input['uri'] = PostHelper::generateSlug($request->title, Auth::id());

        $post->fill($input)->save();
        return redirect()->route('user.show', Auth::user()->username);
    }

    public function like($postSlug)
    {
        $post = Post::getBySlug($postSlug);

        if (!isset($post)) {
            abort(404);
        }

        if (Like::isLiked($post->id)) {
           Like::getAuthUserLike($post->id)->delete();
           return back();
        }

        Like::create(['user_id' => Auth::id(), 'post_id' => $post->id]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $cover = $post->cover;
        
        $post->delete();
        Storage::delete("public/posts/covers/{$cover}");

        return back();
    }
}

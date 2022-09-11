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
        $posts = Post::where('is_draft', 0);
        return response()->json($posts);
    }

    public function published($username)
    {
        $user = User::getByUsername($username);

        if (!isset($user)) {
            abort(404);
        }

        $posts = $user->posts()->where('is_draft', 0)->get();
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
        $posts = $user->posts()->where('is_draft', 1)->get();

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
        $postData['cover']   = PostHelper::UploadImage($request->file('cover'));
        $postData['user_id'] = Auth::id();

        $request->has('draft') ? $postData['is_draft'] = '1' : '';
    
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
        $post = Post::getBySlugOrFail($slug);

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
    public function edit($slug)
    {
        $post = Post::getBySlugOrFail($slug);

        $this->authorize('update', $post);

        return view('auth.post-edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $slug)
    {
        $input = $request->validated();
        $post = Post::getBySlugOrFail($slug);

        $this->authorize('update', $post);

        if ($request->hasFile('cover')){
            $input['cover'] = PostHelper::UpdateImage($request->cover, $post->cover);
        } 
        $input['uri'] = PostHelper::generateSlug($request->title, Auth::id());
        $post->fill($input)->save();
        
        return redirect()->route('user.show', Auth::user()->username);
    }

    public function like($postSlug)
    {
        $post = Post::getBySlugOrFail($postSlug);

        if (Like::isLiked($post->id)) {
            Like::getAuthUserLike($post->id)->delete();
            return back();
        }

        Like::create([
            'user_id' => Auth::id(), 
            'post_id' => $post->id
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::getBySlugOrFail($slug);

        $this->authorize('delete', $post);
        
        $post->delete();

        return back();
    }
}

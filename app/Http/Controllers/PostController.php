<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listPostedOrDraft(string $status)
    {
        $posts = new Post();
        return $posts->getByStatus(auth()->user(), $status);
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

        $cover = $request->file('cover');
        $coverName = $cover->hashName();
        $coverPath = 'public/posts/covers';
        $cover->storeAs($coverPath, $coverName);

        $postData['cover']   = $coverName;
        $postData['user_id'] = auth()->user()->id;
        $postData['uri']     = Str::slug($request->input('title'));

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
    public function show(Post $post)
    {
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
    public function update(StorePostRequest $request, $id)
    {
        $postData = $request->validated();

        $post = Post::find($id);

        if ($request->hasFile('cover')) 
        {
            $cover = $request->file('cover');
            $coverName = $cover->hashName();
            $oldCoverName = $post->cover;

            $coverPath = 'public/posts/covers';
            $cover->storeAs($coverPath, $coverName);

            $postData['cover']   = $coverName;
            Storage::delete($coverPath.'/'.$oldCoverName);
        }

        $postData['uri'] = Str::slug($request->input('title'));

        $post->fill($postData)->save();
        return redirect()->route('profile')->with('message', 'Racunho actualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $cover = $post->cover;
        
        $post->delete();
        Storage::delete("public/posts/covers/{$cover}");

        return redirect()->route('profile');
    }
}

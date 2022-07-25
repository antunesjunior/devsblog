<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $postData = $request->validate([
            'title'       => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'content'     => ['required', 'min:3'],
            'cover'       => ['required','file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $cover = $request->file('cover');
        $coverName = $cover->hashName();
        $coverPath = 'public/posts/covers';
        $cover->storeAs($coverPath, $coverName);

        $postData['cover']   = $coverName;
        $postData['user_id'] = auth()->user()->id;
        $postData['uri']     = Str::slug($request->input('title'));
    
        Post::create($postData);
        return back()->with('message', 'Artigo Publicado com sucesso');
    }

    public function storeAsDraft(Request $request)
    {
        $postData = $request->validate([
            'title'       => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'content'     => ['required', 'min:3'],
            'cover'       => ['required','file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $cover = $request->file('cover');
        $coverName = $cover->hashName();
        $coverPath = 'public/posts/covers';
        $cover->storeAs($coverPath, $coverName);

        $postData['status']  = 'draft';
        $postData['cover']   = $coverName;
        $postData['user_id'] = auth()->user()->id;
        $postData['uri']     = Str::slug($request->input('title'));
    
        Post::create($postData);
        return back()->with('message', 'Racunho guardado com sucesso');
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
    public function update(Request $request, $id)
    {
        $postData = $request->validate([
            'title'       => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'content'     => ['required', 'min:3'],
            'cover'       => ['file', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

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

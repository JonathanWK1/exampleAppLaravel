<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit','update','delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Post/add-edit-post",['post'=> null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image'=> ['image','required']
        ]);

        $imagePath = request("image")->store("post","public");
        $data["image"] = $imagePath;
        $user = auth()->user();
        $user->posts()->create($data);

        return redirect('/profil/'.$user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("Post/view-post",['post'=> $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', [$post, auth()->user()]);
        return view("Post/add-edit-post",['post' => $post]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post)
    {
        $data = request()->validate([
            'caption' => 'required',
            'image'=> 'image'
        ]);
        
        if (request('image')){
            $imagePath = request('image')->store('post','public');
            $post->update(['image' => $imagePath]);
        }
        $post->update(
            ['caption' => $data["caption"]]
        );
        $user = $post->user;
        return redirect('/profil/'.$user->id);

    }

    /**
     * Remove the specified resource from storage.  
     */
    public function destroy(Post $post)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validiated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        Post::create ([
            'title' => $validiated['title'],
            'content' => $validiated['content']
        ]);

        /* Post::create ($request->all()); */
        return response()->json(['massage' => 'Post created succesfully'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        return response() ->json($post, 200);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

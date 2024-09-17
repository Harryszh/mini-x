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

    public function getMyPosts(Request $request)
    {
        return Post::where('user_id', '=', $request->user()->id);
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
            'content' => $validiated['content'],
            'user_id' => $request->user()->id
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
    public function update(Request $request, $id)
    {
        
        $validiated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        
        
        $post = Post::findOrFail($id);

        if ($request->user()->id !== $post->user->id) {
            return response()->json(['message' => 'You are not the owner!'], 401);
        }
        
        $post->update([
            'title' => $validiated['title'],
            'content' => $validiated['content']
        ]);
        $post->save();

        return response()->json(['message' => 'Post updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        if ($request->user()->id !== $post->user->id) {
            return response()->json(['message' => 'You are not the owner!'], 401);
        }
        
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 204);

    }
}

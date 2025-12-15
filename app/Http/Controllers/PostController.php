<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use AuthorizesRequests;

    /*
    |--------------------------------------------------------------------------
    | GET /posts
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return Post::latest()->paginate(10);
    }

    /*
    |--------------------------------------------------------------------------
    | POST /posts
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'community_id' => 'nullable|integer',
        ]);

        $post = Post::create([
            // 'user_id' => auth()->id(),
            'user_id' => Auth::id(),
            'community_id' => $data['community_id'] ?? null,
            'title' => $data['title'],
            'content' => $data['content'] ?? null,
            'status' => 'published',
        ]);

        return response()->json($post, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | GET /posts/{id}
    |--------------------------------------------------------------------------
    */
    public function show(Post $post)
    {
        $post->increaseViews();
        return $post;
    }

    /*
    |--------------------------------------------------------------------------
    | PUT /posts/{id}
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // optional

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE /posts/{id}
    |--------------------------------------------------------------------------
    */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // optional

        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}

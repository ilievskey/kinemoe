<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function posts()
    {
        $highlightedPosts = Post::where('is_highlighted', true)->latest()->get();
        $posts = Post::with('user')->latest()->paginate(3);
        return view('posts.index', compact('highlightedPosts', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    public function highlight(Request $request, Post $post)
    {
        $post->is_highlighted = !$post->is_highlighted;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post highlighted status updated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required|string',
        ]);

        $post = Post::create([
            'post_title' => $validated['post_title'],
            'post_content' => $validated['post_content'],
            'post_by' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'post_title' => 'sometimes|required|string|max:255',
            'post_content' => 'sometimes|required|string'
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->post_by && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $post->delete();

        return response()->json(['success' => 'Post deleted successfully.']);
    }
}

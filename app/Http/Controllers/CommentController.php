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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'comment_content' => 'required',
        ]);

        $post->comments()->create([
            'comment_content' => $validated['comment_content'],
            'comment_by' => auth()->id(),
            'comment_on' => $post->id,
        ]);

        return redirect()->route('post.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'comment_content' => 'sometimes|required',
        ]);

        $comment->update($validated);

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Comment $comment)
        {
            if (Auth::id() !== $comment->comment_by && !Auth::user()->isAdmin()) {
                abort(403);
            }

            $comment->delete();

            return response()->json(['success' => 'Comment deleted successfully.']);
        }
}

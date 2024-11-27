<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportPost(Request $request, Post $post)
    {
        $request->validate(['reason' => 'required|string|max:255']);
        
        Report::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'reason' => $request->reason,
        ]);

        // return back()->with('success', 'Post reported successfully.');
        return response()->json(['success' => true]);
    }

    public function reportComment(Request $request, Comment $comment)
    {
        $request->validate(['reason' => 'required|string|max:255']);
        
        Report::create([
            'user_id' => auth()->id(),
            'comment_id' => $comment->id,
            'reason' => $request->reason,
        ]);

        // return back()->with('success', 'Comment reported successfully.');
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request){
        $user = auth()->user();
        $postId = $request->input('post_id');
        $commentId = $request->input('comment_id');
        
        $likeQuery = Like::where('liked_by', $user->id);
        if($postId){
            $likeQuery->where('liked_post', $postId);
        } else if($commentId){
            $likeQuery->where('liked_comment', $commentId);
        } else{
            return response()->json(['message' => 'Invalid request'], 400);
        }

        $like = $likeQuery->first();

        if($like){
            $like->delete();
            return response()->json(['message' => 'unliked']);
        } else{
            $newLike = new Like();
            $newLike->liked_by = $user->id;
            if ($postId) {
                $newLike->liked_post = $postId;
            } else {
                $newLike->liked_comment = $commentId;
            }
            $newLike->save();
            return response()->json(['message' => 'liked']);
        }
    }
}

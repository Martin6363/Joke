<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        $liker = Auth::user();
        if (!$liker->hasLiked($post)) {
            $liker->likes()->attach($post);

            $likeCount = $post->likes()->count();
            return response()->json(['message' => 'Liked successfully', 'likes_count' => $likeCount]);
        }

        return response()->json(['message' => 'Already liked', 'likes_count' => $post->likes()->count()]);
    }

    public function unlike(Post $post)
    {
        $liker = Auth::user();

        if ($liker->hasLiked($post)) {
            $liker->likes()->detach($post);

            $likeCount = $post->likes()->count();
            return response()->json(['message' => 'Unliked successfully', 'likes_count' => $likeCount]);
        }

        return response()->json(['message' => 'Not yet liked', 'likes_count' => $post->likes()->count()]);
    }
}   

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewProfileController extends Controller
{
    public function index(Request $request) {
        $view_id = $request->id;
        $user = User::withCount('posts')->with(['posts' => function($query) {
            $query->withCount('likes');
        }])->find($view_id);
        
        $totalLikes = 0;
        foreach($user->posts as $post) {
            $totalLikes += $post->likes_count;
        }

        if (!$user) {
            return abort(404);
        }
        
        return view('profile.view', compact('user', 'totalLikes'));
    }
}

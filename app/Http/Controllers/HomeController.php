<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    public function index (Request $request) {
        $usersWithPosts = User::with(['posts' => function ($query) {
            $query->where('published', 1);
        }])->orderBy('id', 'desc')->paginate(2);
     
        $activeUsers = User::whereHas('posts', function ($query) {
            $query->where('published', 1);
        })->orderBy('id', 'desc')->get();

        if ($request->ajax()) {
            $html = '';
            foreach ($usersWithPosts as $user) {
                foreach ($user->posts as $post) {
                    if ($post->user_id >= 1) {
                        $html .= view('components.user-and-post-section', compact('user', 'post'))->render();
                    }
                }
            }
            return response()->json(['html' => $html]);
        }

        $categories = Category::withCount('posts')->get();
        $theme = $request->cookie('theme');
        return view('home', compact(
            'usersWithPosts',
            'activeUsers',
            'categories',
            'theme'
        ));
    }

    
    // Theme Mode
    public function createAndUpdate (Request $request) {
        $theme = $request->input('theme');

        if($theme && in_array($theme, ['light', 'dark'])) {
            $cookie = cookie('theme', $theme, 60*24*365); // 1 year expiry
        }

        return back()->withCookie($cookie);
    }
}

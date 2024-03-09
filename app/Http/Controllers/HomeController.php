<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index (Request $request) {
        $usersWithPosts = User::with('posts')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        
        $theme = $request->cookie('theme');
        return view('home', compact(
            'usersWithPosts',
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

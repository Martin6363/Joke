<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $usersWithPosts = User::with('posts')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        
        return view('home', compact(
            'usersWithPosts',
            'categories'
        ));
    }
}

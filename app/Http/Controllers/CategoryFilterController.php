<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryFilterController extends Controller
{
    public function filter(Request $request, $category = null)
    {
        $usersWithPostsQuery = User::with(['posts' => function ($query) {
            $query->where('published', 1);
        }])->orderBy('id', 'desc');

        if ($category) {
            $categoryId = Category::where('name', $category)->value('id');

            if ($categoryId) {
                $usersWithPostsQuery->whereHas('posts', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                });
            }
        }
        $categories = Category::withCount('posts')->get();

        $usersWithPosts = $usersWithPostsQuery->paginate(3);

        $activeUsers = User::whereHas('posts', function ($query) {
            $query->where('published', 1);
        })->orderBy('id', 'desc')->get();

        return view('home', compact([
            'usersWithPosts',
            'categories',
            'activeUsers'
        ]));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SearchPostController extends Controller
{
    public function getAutocomplete(Request $request)
    {
        $searchData = $request->data;
        $posts = Post::where('published', 1)
                     ->where('title', 'like', "%$searchData%")->skip(0)->take(7)
                     ->get(['id', 'title']);

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts,
            ]);
        } 
    }

    public function searchResult($name) {
        $search = $name;
        $posts =  Post::with('user')->where('title', 'like', "%$name%")->get();
        
        $posts->pluck('user')->unique()->filter();

        return view('search.search', compact('posts', 'search'));
    }
    
    public function searchPosts (Request $request) {
        $search = $request->search;
        $request->validate([
            'search' => 'required|string',
        ]);
        
        if ($search != "") {
            $posts = Post::where('published', 1)
                    ->where('title', 'like', "%$search%")->get();

            if ($posts) {
                return view('search.search', compact(['posts', 'search']));
            }
             else {
                redirect()->back()->with('status', "No Posts matched your search");
            }
        } else {
            return redirect()->back();
        }
    }

}



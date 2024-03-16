<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Mockery\Matcher\Type;

class SearchPostController extends Controller
{
    public function getAutocomplete(Request $request)
    {
        $searchData = $request->data;
        $posts = Post::where('published', 1)
                     ->where('title', 'like', "%$searchData%")
                     ->get(['id', 'title']);

        if ($request->ajax()) {
            return response()->json([
                'posts' => $posts,
            ]);
        } 
    }

    public function searchResult($name) {
        $search = $name;
        $posts =  Post::with('user')->where('title', $name)->get();
        
        $posts->pluck('user')->unique()->filter();

        return view('search.search', compact('posts', 'search'));
    }
    
    public function searchPosts (Request $request) {
        $search = $request->search;
        // $request->session()->put('search', $search);
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



<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();

        $posts = Post::with('category')
        ->where('user_id', $userId)->where('published', 0)->orderBy('id', 'desc')->get();
        return view('post.index', compact('posts'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        $postPublished = [
            1 => 'Public',
            0 => 'Private'
        ];
        return view('post.create', compact(
            'category',
            'postPublished'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['category_id'] = $request->category;
        $data['published'] = $request->published;
        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('public/post-images', $imageName);
            
        $data['image'] = $imageName;

        Post::create($data);
        return redirect()->to(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('post.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        $postPublished = [
            1 => 'Public',
            0 => 'Private'
        ];

        return view('post.edit', compact(
            'post', 
            'category',
            'postPublished'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validatedData = $request->validated();

        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->category_id = $validatedData['category'];
        $post->published = $validatedData['published'];

        if ($request->hasFile('image')) {
            if ($post->image && Storage::exists('public/post-images/' . $post->image)) {
                Storage::delete('public/post-images/' . $post->image);
            }
    
            // Store the new image
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('public/post-images', $imageName);
            $post->image = $imageName;
        }
    
        $post->update();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request, Post $post)
    {
        if ($request->user()->id == $post->user_id) {
            if ($post->image) {
                Storage::disk('public')->delete('post-images/' . $post->image);
            }
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['message' => 'Permission Denied'], 403);
    }
}

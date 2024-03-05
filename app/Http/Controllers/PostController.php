<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
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
        ->where('user_id', $userId)->orderBy('id', 'desc')->get();
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
        return view('post.create', compact(
            'category'
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

        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('public/post-images', $imageName);
            
        $data['image'] = $imageName;

        Post::create($data);
        return redirect()->to(route('post.index'));
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
        return view('post.edit', compact(
            'post', 
            'category'
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
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images');
            $post->image = $imagePath;
        }
    
        $post->update();

        return redirect()->to(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete the associated image from storage
        if ($post->image) {
            Storage::delete('post-images/' . $post->image);
        }
    
        // Delete the post
        $post->delete();
    
    }
}

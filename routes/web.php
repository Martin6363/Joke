<?php

use App\Http\Controllers\CategoryFilterController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchPostController;
use App\Http\Controllers\ThemeController;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');
Route::post('/cookie/create/update', [HomeController::class, 'ThemeUpdate'])->name('create-update');


Route::middleware('auth')->group(function () {
    ## category routes
    Route::get('home/category/{category?}', [CategoryFilterController::class, 'filter'])->name('category.filter');
    ## post routes
    Route::resource('post', PostController::class);
    Route::delete('/post/{post}', [PostController::class, 'delete'])->name('post.delete');
    ## Search Routes
    Route::get('/search', [SearchPostController::class, 'getAutocomplete'])->name('search');
    Route::get('/search/{name}', [SearchPostController::class, 'searchResult'])->name('search.result');
    Route::get('/search_posts', [SearchPostController::class, 'searchPosts'])->name('search.posts');
    ## Like Routes
    Route::post('posts/{post}/like', [PostLikeController::class, 'like'])->name('post.like');
    Route::delete('posts/{post}/unlike', [PostLikeController::class, 'unlike'])->name('post.unlike');
    ## Profile Routes
    Route::get('/profile', [ProfileController::class,'index'])->name('profile');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/settings', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile/view/{id}', [ViewProfileController::class, 'index'])->name('profile.view');
});


require __DIR__.'/auth.php';

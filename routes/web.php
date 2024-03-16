<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ViewProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchPostController;
use App\Http\Controllers\ThemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::post('/cookie/create/update', [HomeController::class, 'createAndUpdate'])->name('create-update');


Route::middleware('auth')->group(function () {
    ##post routes
    Route::resource('post', PostController::class);
    ## Search Routes
    Route::get('/search', [SearchPostController::class, 'getAutocomplete'])->name('search');
    Route::get('/search/{name}', [SearchPostController::class, 'searchResult'])->name('search.result');
    Route::get('/search_posts', [SearchPostController::class, 'searchPosts'])->name('search.posts');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('profile/view/{id}', [ViewProfileController::class, 'index'])->name('profile.view');
});


require __DIR__.'/auth.php';

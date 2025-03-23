<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index() {
        $userId = Auth::user()->id;

        $authUserWithPosts = User::withCount('posts')->with(['posts' => function($query) {
            $query->withCount('likes');
        }])->find($userId);
        
        $totalLikes = 0;
        if ($authUserWithPosts->posts) {
            foreach($authUserWithPosts->posts as $post) {
                $totalLikes += $post->likes_count;
            }
        } else {
            return abort(404);
        }

        if (!$authUserWithPosts) {
            return abort(404);
        }
        return view('profile.index', compact([
            'authUserWithPosts',
            'totalLikes'
        ]));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();
        
        $user->fill($validatedData);
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Save the user changes
        $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    public function updateAvatar(ProfileUpdateRequest $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
    
            if ($user->avatar && Storage::exists('public/avatar/' . $user->avatar)) {
                Storage::delete('public/avatar/' . $user->avatar);
            }
    
            
            $avatarPath = $avatar->save(storage_path('app/public/avatar/avatar-' . $avatar));
            $avatarFileName = $avatarPath;
    
            $user->avatar = $avatarFileName;
            $user->save();
    
            return response()->json(['message' => 'Profile updated successfully', 'avatar' => $user->avatar]);
        } else {
            return response()->json(['error' => 'No avatar file provided'], 400);
        }
    }
    
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
        {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current-password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        }
}

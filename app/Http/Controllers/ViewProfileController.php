<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewProfileController extends Controller
{
    public function index(Request $request) {
        $view_id = $request->id;
        $user = User::withCount('posts')->find($view_id);
        if (!$user) {
            return abort(404);
        }
        
        return view('profile.view', compact('user'));
    }
}

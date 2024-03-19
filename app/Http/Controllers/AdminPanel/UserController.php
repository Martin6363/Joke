<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index () {
        $users = User::all();

        return response()->json([
            'results' => $users
        ], 200);
    }

    public function show ($id) {
        $users = User::find($id);

        if(!$users) {
            return response()->json([
                'message' => 'User Not Found'
            ], 404);
        }

        return response()->json([
            'result' => $users
        ], 200);
    }

    public function store (UserStoreRequest $request) {
        try {
            $validData = $request->validated();

            $hashedPassword = Hash::make($validData['password']);
            User::create([
                'name' => $validData['name'],
                'email' => $validData['email'],
                'password' => $hashedPassword,
                'gender' => $validData['gender'],
                'is_hide' => $validData['is_hide'],
                'dob' => $validData['dob'],
                'avatar' => $validData['avatar'],
            ]);

            return response()->json([
                'message' => "User successfully created.",
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update (Request $request, $id) {
        try {
            $users = User::find($id);
            $hashedPassword = Hash::make('password');
            if (!$users) {
                return response()->json([
                    'message' => 'User Not Found'
                ], 404);
            }

            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $hashedPassword;
            $users->gender = $request->gender;
            $users->is_hide = $request->is_hide;
            $users->dob = $request->dob;
            $users->avatar = $request->avatar;

            $users->update();
            

            return response()->json([
                'message' => "User successfully updated."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!",
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy ($id) {
        $users = User::find($id);
        if (!$users) {
            return response()->json([
                'message' => 'User Not Found'
            ], 404);
        }

        $users->delete();

        return response()->json(null, 204);
    }
}

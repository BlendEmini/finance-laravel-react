<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function register(Request $request){ 
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');
        $input = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ];
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|in:admin,client,freelancer',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user = \App\Models\User::create($input);
        Auth::login($user);
        return response()->json($user, 201);
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $user = \App\Models\User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return response()->json($user, 200);
    }
    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}

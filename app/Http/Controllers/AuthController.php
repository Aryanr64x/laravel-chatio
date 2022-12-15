<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = User::create(['username' => $data['username'], 'password' => bcrypt($data['password'])]);
        $token = $user->createToken('chatio')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);

    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $data['username'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(["msg" => "Failed Auth"], 400);
        }

        $token = $user->createToken('chatio')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);


    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(["msg" => "Logged out"]);
    }
}
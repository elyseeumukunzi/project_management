<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'in:admin,user' // Optional, can be 'admin' or 'user'
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => $data['role'] ?? 'user',
    ]);

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'status' => 201,
        'message' => 'Registered successfully',
        'data' => [
            'user' => $user,
            'token' => $token
        ]
    ], 201);
}
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string'
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'status' => 401,
            'message' => 'Invalid credentials'
        ], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'status' => 200,
        'message' => 'Login successful',
        'data' => [
            'user' => $user,
            'token' => $token
        ]
    ]);
}

public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Logged out successfully',
    ]);
}

public function me(Request $request)
{
    return response()->json([
        'status' => 200,
        'message' => 'User profile',
        'data' => $request->user()
    ]);
}
}

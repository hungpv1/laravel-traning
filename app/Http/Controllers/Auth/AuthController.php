<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $params = $request->validated();
        if (Auth::attempt(['email' => $params['email'], 'password' => $params['password']])) {
            $user = Auth::user();
            $tokenResult = $user->createToken($user->email);
            $token = $tokenResult->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);

    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'name' => $validatedData['name']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }
}

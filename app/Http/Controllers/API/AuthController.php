<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if (auth()->attempt($loginData)) {
//            $accessToken = Auth::user()->createToken('My Auth Token')->accessToken;
            // OR
            $accessToken = auth()->user()->createToken('My Auth Token')->accessToken;

            return response([
                'status' => 'success',
                'user' => auth()->user(),
                'access_token' => $accessToken
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'Invalid Credentials',
        ]);

    }
}

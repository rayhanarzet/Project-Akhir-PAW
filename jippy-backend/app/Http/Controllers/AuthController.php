<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{ 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users', 
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('auth_token', $token, 60 * 24); 

        return response()->json([
            'message' => 'Hore! Register berhasil',
            'data' => $user,
            'token' => $token 
        ], 201)->withCookie($cookie);;
    }


    
    public function login(Request $request)
    {
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('auth_token', $token, 60 * 24);
        
        return response()->json([
            'message' => 'Login sukses!',
            'data' => $user,
            'token' => $token
        ], 200)->withCookie($cookie);
    }


    
    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        $cookie = cookie()->forget('auth_token');
        
        return response()->json(['message' => 'Logout berhasil'])->withCookie($cookie);
    }
}

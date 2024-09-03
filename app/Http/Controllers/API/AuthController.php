<?php

namespace App\Http\Controllers\API;
  
use App\Http\Controllers\Controller as Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
  
class AuthController extends Controller
{
    /**
     * Handle user login and generate a JWT token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
 
    public function login(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
       // Retrieve the credentials (email and password) from the request
       $credentials = $request->only('email', 'password');

       // Attempt to authenticate the user with the given credentials

        $token = Auth::attempt($credentials);
          // If authentication fails, return an "Unauthorized" response
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);

    }
/**
     * Register a new user and return a JWT token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => Auth::login($user),
                'type' => 'bearer',
            ]
        ]);
    }
/**
     * Log out the authenticated user and invalidate the JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
/**
     * Refresh the JWT token for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}


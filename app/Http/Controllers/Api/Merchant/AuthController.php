<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = $this->guard()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }
        return $this->respondWithToken($token);
    }
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }
    public function me()
    {
        return response()->json($this->guard()->user());
    }
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}

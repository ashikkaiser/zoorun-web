<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        return response()->json(User::with('branch')->find($this->guard()->user()->id));
    }
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }


    public function updateToken(Request $request)
    {
        $user = User::find($this->guard()->user());
        $user->app_token = $request->token;
        $user->save();
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}

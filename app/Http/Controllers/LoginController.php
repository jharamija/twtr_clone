<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function authenticate(Request $request) {
        $validator = Validator::make(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $credentials = request(['email', 'password']);

        $token = auth('api')->attempt($credentials);

        if($token === false) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function getAuthUser(){
        return response()->json(auth('api')->user());
    }

    public function logout() {

        auth('api')->logout();

        return response()->json(['message' => 'successfully logged out']);
    }

    public function refreshToken() {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user(),
        ]);
    }
}

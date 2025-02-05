<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->errors(),
            ], 422);
        }

        $user = Auth::attempt($request->only('email', 'password'));
        if ($user) {
            return response()->json([
                'message' => 'Login success',
                'token' => Auth::user()->createToken('auth_token')->plainTextToken,
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

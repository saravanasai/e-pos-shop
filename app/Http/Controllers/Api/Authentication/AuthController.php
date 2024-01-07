<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(["message" => 'User does not exist'], 422);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Password mismatch"], 422);
        }

        $token = $user->createToken($request->device_name . "-" . (count($user->tokens) + 1))->plainTextToken;

        $response = [
            'token' => $token,
            'user' => $user
        ];

        return response()->json($response, 200);
    }

    public function user()
    {
        return request()->user();
    }

    public function logout()
    {
        // Revoke the token that was used to authenticate the current request
        request()->user()->currentAccessToken()->delete();
        return response()->json([], 204);
    }

    public function logoutFromAllDevices()
    {
        // Revoke all tokens
        request()->user()->tokens()->delete();
        return response()->json([], 204);
    }
}

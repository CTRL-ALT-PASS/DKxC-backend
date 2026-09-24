<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string',
            'pin_code'    => 'required|string',
        ]);

        if (! Auth::attempt([
            'employee_id' => $validated['employee_id'],
            'password'    => $validated['pin_code'],
        ])) {
            return response()->json(['message' => 'Invalid Employee ID or PIN'], 401);
        }
        $token = Auth::user()->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}

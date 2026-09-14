<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //imput validation
        $validated = $request->validate([
            'employee_id' => 'required|string|max:10',
            'pin_code' => 'required|string|size:5',
        ]);

        //find employee
        $employee = Employee::where(
            'employee_id',
            $validated['employee_id']
        )->first();

        //if no employee validation
        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid employee ID or PIN.'
            ], 401);
        }

        //inactive employee
        if ($employee->employment_status !== 'Active') {
            return response()->json([
                'success' => false,
                'message' => 'This employee account is not active.'
            ], 403);
        }

        //incorrect pin
        if (!Hash::check($validated['pin_code'], $employee->pin_code)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid employee ID or PIN.'
            ], 401);
        }

        //employee token
        $token = $employee->createToken('api-token')->plainTextToken;

        //successful response
        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'employee' => $employee
        ]);
    }

    //logout employee
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.'
        ]);
    }

    //get employee
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'employee' => $request->user()
        ]);
    }
}
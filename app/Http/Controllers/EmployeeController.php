<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // GET ALL
    public function index(Request $request)
	{
		$employees = Employee::query();

		if ($request->has('search')) {
			$employees->where('employee_id', 'like', "%{$request->query('search')}%")
					  ->orWhere('name', 'like', "%{$request->query('search')}%");
		}

		return response()->json($employees->get(), 200);
	}
    
    // GET ONE
    public function show(Employee $employee)
	{
        return response()->json($employee, 200);
    }
    
    // CREATE
    public function store(Request $request)
	{
        $validated = $request->validate([
            'employee_id'       => 'required|string|max:10|unique:employee,employee_id',
            'first_name'        => 'required|string|max:50',
            'last_name'         => 'required|string|max:50',
            'position'          => 'nullable|string|max:500',
            'phone_number'      => 'nullable|string|max:20',
            'hire_date'         => 'nullable|date',
            'employment_status' => 'nullable|in:Active,Inactive,Terminated',
            'pin_code'          => 'required|string|min:5',
        ]);
    
        $validated['pin_code'] = Hash::make($validated['pin_code']);
        $employee = Employee::create($validated);
    
        return response()->json(['message' => 'Employee created successfully!', 'data' => $employee], 201);
    }
    
    // UPDATE
    public function update(Request $request, Employee $employee)
	{
        $validated = $request->validate([
            'first_name'        => 'sometimes|string|max:50',
            'last_name'         => 'sometimes|string|max:50',
            'position'          => 'sometimes|string|max:500',
            'phone_number'      => 'sometimes|string|max:20',
            'hire_date'         => 'sometimes|date',
            'employment_status' => 'sometimes|in:Active,Inactive,Terminated',
            'pin_code'          => 'sometimes|string|min:5',
        ]);
    
        if ($request->has('pin_code')) {
            $validated['pin_code'] = Hash::make($validated['pin_code']);
        }
        
        $employee->update($validated);
    
        return response()->json(['message' => 'Employee updated!', 'data' => $employee], 200);
    }
    
    // DELETE
    public function destroy(Employee $employee)
	{
        $employee->delete();
        return response()->json(['message' => 'Employee deleted!'], 200);
    }
}

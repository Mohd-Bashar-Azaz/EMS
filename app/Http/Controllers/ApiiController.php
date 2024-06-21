<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;


class ApiiController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        return response()->json([
            'message' => count($employees) . ' Employees  found',
            'data' => $employees,
            'status' => true
        ], 200);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee != null) {
            return response()->json([
                'message' => 'Record found',
                'data' => $employee,
                'status' => true

            ], 200);
        } else {
            return response()->json([
                'message' => 'Record  not found',
                'data' => [],
                'status' => true

            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'role' => 'required|min:3',
            'salary' => 'required|numeric'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'errors' => $validator->errors(),
                'status' => false

            ], 200);
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->description = $request->description;
        $employee->save();


        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $ext; //unique img name

        // save img to employees directory
        $image->move(public_path('uploads/employees'), $imageName);

        // save img name in db
        $employee->image = $imageName;
        $employee->save();

        return response()->json([
            'message' => 'Emoloyee added successfully',
            'data' => $employee,
            'status' => true

        ], 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee == null) {
            return response()->json([
                'message' => 'Employee not found',
                'status' => false
            ], 200);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'role' => 'required|min:3',
            'salary' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 200);
        }

        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->description = $request->description;
        $employee->save();


        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee,
            'status' => true

        ], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if ($employee == null) {
            return response()->json([
                'message' => 'Employee not found',
                'status' => false
            ], 200);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully',
            'status' => true
        ], 200);
    }

   
}

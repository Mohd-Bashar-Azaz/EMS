<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;



class EmployeeController extends Controller
{
    // this method will show products page
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'DESC')->get();

        return view('employees.list', [
            'employees' => $employees
        ]);

    }


    // this method will create product page
    public function create()
    {
        return view('employees.create');
    }

    // this method will store a product in db
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'role' => 'required|min:3',
            'salary' => 'required|numeric'

        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('employees.create')->withInput()->withErrors($validator);
        }

        // here well will insert employee in db
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->description = $request->description;
        $employee->save();

        if ($request->image != "") {
            // here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique img name

            // save img to employees directory
            $image->move(public_path('uploads/employees'), $imageName);

            // save img name in db
            $employee->image = $imageName;
            $employee->save();
        }
        return redirect()->route('employees.index')->with('SUCCESS', 'Employee added successfully');
    }


    // this method will show edit product page
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', [
            'employee' => $employee
        ]);
    }

    // this method will update a employee
    public function update($id, Request $request)
    {

        $employee = Employee::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'role' => 'required|min:3',
            'salary' => 'required|numeric'
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('employees.edit', $employee->id)->withInput()->withErrors($validator);
        }

        // here well will update product in db
        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->description = $request->description;
        $employee->save();

        if ($request->image != "") {
            // delete old img
            File::delete(public_path('uploads/employees/' . $employee->image));

            // here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique img name

            // save img to products directory
            $image->move(public_path('uploads/employees'), $imageName);

            // save img name in db
            $employee->image = $imageName;
            $employee->save();
        }

        return redirect()->route('employees.index')->with('SUCCESS', 'Employee updated successfully');
    }


    // this method will delete a product
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // delete img
        File::delete(public_path('uploads/employees/' . $employee->image));

        // delete employee from db
        $employee->delete();


        return redirect()->route('employees.index')->with('SUCCESS', 'Employee deleted successfully !');

    }
}

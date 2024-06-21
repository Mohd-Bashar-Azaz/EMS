<?php
// this controller is for datas table (which represents personal info of the employee)
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Datas;





class SubController
{
    /**
     * Display a listing of the resource.
     */
    public function index($employeeId)
    {
        $datas = Datas::where('employee_id', $employeeId)->get();
        return view('datas.data', [
            'datas' => $datas

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // this create function doesnt work properly as it gets the error employee_id not found 
    // but it creates employee_id =id(of employees table) after that,and you can create personal
    // info of the employee you want to after clicking P~id ->(gets error) then by clicking more info button
    // and then edit button 
    public function create($employeeId)
    {
        $datas = Datas::where('employee_id', $employeeId)->first();

        if (!$datas) {
            // Create a new datas record
            $datas = new Datas();
            $datas->employee_id =$employeeId; // Set the employee_id
            $datas->save(); // Save the Datas record

            // Associate the profile with the newly created datas
            $datas->create()->save(); // Create and associate the profile
            return redirect()->route('datas.create', ['employeeId' => $datas->employee_id]);
        }
        else{
            return redirect()->route('datas.create', ['employeeId' => $datas->employee_id]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
           'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('datas.create')->withInput()->withErrors($validator);
        }

        // here well will insert employee in db
        $datas = new Datas();
        $datas->phone = $request->phone;
        $datas->email = $request->email;
        $datas->address = $request->address;
        $datas->experience = $request->experience;
        $datas->save();
        return redirect()->route('employees.index')->with('SUCCESS', 'Employee personal details added successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $datas = Datas::findOrFail($id);
        return view('datas.edit', [
            'datas' => $datas

        ]);
    }

    // this method will update a employee
    public function update($id, Request $request)
    {

        $datas = Datas::findOrFail($id);

        $rules = [
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('datas.edit', $datas->$id)->withInput()->withErrors($validator);
        }

        // here well will update product in db

        $datas->phone = $request->phone;
        $datas->email = $request->email;
        $datas->address = $request->address;
        $datas->experience = $request->experience;
        $datas->save();

        return redirect()->route('employees.index')->with('SUCCESS', 'Employee Personal Details updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $datas = Datas::findOrFail($id);



    //     // delete employee from db
    //     $datas->delete();


    //     return redirect()->route('employees.index')->with('SUCCESS', 'Employee personal details deleted successfully !');

    // }
    // public function createProfile(Request $request, $employeeId)
    // {
    //     // Assuming 'employee_id' is a foreign key in the 'datas' table

    // }
}

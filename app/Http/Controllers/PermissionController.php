<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('r-p.permission.index', [
            'permissions' => $permissions
        ]);
    }
    public function create()
    {
        return view('r-p.permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);
        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permissions')->with('status', 'Permission Created Successfully!');
    }
    public function edit(Permission $permission)
    {
        return view('r-p.permission.edit', [
            'permission' => $permission
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);
        $permission->update([
            'name' => $request->name

        ]);

        return redirect('permissions')->with('status', 'Permission Updated Successfully!');
    }
    public function destroy($permissionId)
    {
        $permission=Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission Deleted Successfully!');




    }
}

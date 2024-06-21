<?php

namespace App\Http\Controllers;

// use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class ApiController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'message' => count($users) . ' users  found',
            'data' => $users,
            'status' => true
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user != null) {
            return response()->json([
                'message' => 'Record found',
                'data' => $user,
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'errors' => $validator->errors(),
                'status' => false

            ], 200);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'message' => 'User added successfully',
            'data' => $user,
            'status' => true

        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json([
                'message' => 'User not found',
                'status' => false
            ], 200);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 200);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
            'status' => true

        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user == null) {
            return response()->json([
                'message' => 'User not found',
                'status' => false
            ], 200);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
            'status' => true
        ], 200);
    }

    // public function upload(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'required|mimes:png,jpg,jpeg,gif'
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Please fix the errros',
    //             'errors' => $validator->errors()
    //         ]);
    //     }

    //     $img = $request->image;
    //     $ext = $img->getClientOriginalExtension();
    //     $imageName = time() . '.' . $ext;
    //     $img->move(public_path() . '\uploads', $imageName);

    //     $image = new Image;
    //     $image->image = $imageName;
    //     $image->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Image uploaded successfully',
    //         'path' => asset('uploads/' . $imageName),
    //         'data' => $image
    //     ]);
    // }
}

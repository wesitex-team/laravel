<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboards.admin.admin-users.admin-users-main', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        
        // Default values for required fields
        $user->gender = 'male'; // Default or add to form
        $user->dob = '2000-01-01'; // Default
        $user->race = 'N/A';
        $user->religion = 'N/A';
        $user->address = 'N/A';
        $user->phone = '0000000000';
        
        $user->save();

        return response()->json(['success' => 'User created successfully.']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'user_type' => 'required'
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        if($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json(['success' => 'User updated successfully.']);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'User deleted successfully.']);
    }
}

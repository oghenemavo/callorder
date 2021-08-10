<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $data['page'] = 'User Management';
        $data['users'] = User::all();
        $data['roles'] = Role::all();
        return view('admin.manage.users', $data);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:7',
            'role' => 'required'
        ];

        $request->validate($rules);

        $result = DB::transaction(function() use($request) {
            $data = $request->all();
            $password = '123456';
            $data['password'] = Hash::make($password);
            
            $role = Role::find($request->role);
            $user = User::create($data);
            return $user->roles()->attach($role);
        });


        if ($result) {
            return back()->with('message', 'User Created Successfully!');
        }
        return back()->with('error', 'Unable to Create User!');
    }

    public function edit(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'required|min:7',
            'role' => 'required'
        ];

        $request->validate($rules);

        $result = DB::transaction(function() use($request, $user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->is_active = '1';
            
            $role = Role::find($request->role);
            $user->save();
            $user->roles()->sync($role);
            return $user->isDirty();
        });

        if ($request->ajax()) {
            if ($result) {
                return response()->json(['success' => 'User Edited Successfully!']);
            }
            return response()->json(['info' => 'No Changes made!']);
        } else {
            if ($result) {
                return back()->with('success', 'User Edited Successfully!');
            }
            return back()->with('success', 'No Changes made!');
        }
        return back()->with('error', 'Unable to Edit User!');
    }

    public function deactivate(Request $request, User $user)
    {
        $user->is_active = '0';
        $result = $user->save();
        if ($result) {
            if ($request->ajax()) {
                return response()->json(['success' => 'User Deactivated Successfully!']);
            }
            return back()->with('success', 'User Deactivated Successfully!');
        }
        return back()->with('error', 'Unable to deactivate User!');
    }
    

    public function activate(Request $request, User $user)
    {
        $user->is_active = '1';
        $result = $user->save();
        if ($result) {
            if ($request->ajax()) {
                return response()->json(['success' => 'User Activated Successfully!']);
            }
            return back()->with('success', 'User Activated Successfully!');
        }
        return back()->with('error', 'Unable to Activate User!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Roles & Permissions';
        $data['roles'] = Role::all();
        return view('admin.manage.roles', $data);
    }

    public function createRole(Request $request)
    {
        $rules = [
            'role' => 'required|min:3|unique:roles,name',
        ];

        $request->validate($rules);

        $data['name'] = $request->role;
        $data['slug'] = Str::of(strtolower($data['name']))->slug('_');

        $result = Role::create($data);

        if ($result) {
            return back()->with('message', 'Role Created Successfully!');
        }
        return back()->with('error', 'Unable to Create Role!');
    }

    public function updateRole(Request $request, Role $role)
    {
        $rules = [
            'role' => [
                'required',
                Rule::unique('roles', 'name')->ignore($role),
            ],
        ];

        $request->validate($rules);

        $role->name = $request->role;

        if ($role->isDirty('name')) {
            $role->slug = Str::of(strtolower($request->role))->slug('_');
            $role->save();

            return back()->with('message', 'Role Edited Successfully!');
        } else {
            return back()->with('info', 'No changes made!');
        }
        return back()->with('error', 'Unable to edit Role!');
    }

    public function deleteRole(Request $request, Role $role)
    {
        $deleted = $role->destroy($role->id);
        if ($deleted) {
            if($request->ajax()){
                return response()->json(['success' => true]);
            } else {
                return back()->with('message', 'Event Deleted Successfully!');
            }
        }
        return back()->with('error', 'Unable to Delete Role!');
    }
}

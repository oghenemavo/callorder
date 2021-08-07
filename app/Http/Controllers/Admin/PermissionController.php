<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Permissions';
        $data['permissions'] = Permission::all();
        return view('admin.manage.permissions', $data);
    }

    public function createPermission(Request $request)
    {
        $rules = [
            'permission' => 'required|min:3|unique:permissions,name',
        ];

        $request->validate($rules);

        $data['name'] = $request->permission;
        $data['slug'] = Str::of(strtolower($data['name']))->slug('_');

        $result = Permission::create($data);

        if ($result) {
            return back()->with('message', 'Permission Created Successfully!');
        }
        return back()->with('error', 'Unable to Create Permission!');
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        $rules = [
            'permission' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($permission),
            ],
        ];

        $request->validate($rules);

        $permission->name = $request->permission;

        if ($permission->isDirty('name')) {
            $permission->slug = Str::of(strtolower($request->permission))->slug('_');
            $permission->save();

            return back()->with('message', 'permission Edited Successfully!');
        } else {
            return back()->with('info', 'No changes made!');
        }
        return back()->with('error', 'Unable to edit permission!');
    }

    public function deletePermission(Request $request, Permission $permission)
    {
        $deleted = $permission->destroy($permission->id);
        if ($deleted) {
            if($request->ajax()){
                return response()->json(['success' => true]);
            } else {
                return back()->with('message', 'Permission Deleted Successfully!');
            }
        }
        return back()->with('error', 'Unable to Delete Permission!');
    }
}

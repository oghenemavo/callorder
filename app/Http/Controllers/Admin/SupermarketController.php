<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supermarket;
use App\Models\User;
use Illuminate\Http\Request;

class SupermarketController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Manage Supermarket';
        $data['markets'] = Supermarket::all();
        $data['users'] = User::join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')->where('roles.slug', 'admin')->get(['users.*']);
        $data['sm_users'] = Supermarket::all()->pluck('user_id');
        return view('admin.manage.supermarket', $data);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'lga' => 'required|min:2',
            'state' => 'required|min:2',
            'user' => 'required',
        ];

        $request->validate($rules);

        $data = $request->all();
        $data['user_id'] = $request->user;
        $result = Supermarket::create($data);

        if ($result) {
            return back()->with('message', 'Market Created Successfully!');
        }
        return back()->with('error', 'Unable to Create Market!');
    }

    public function edit(Request $request, Supermarket $supermarket)
    {
        $rules = [
            'name' => 'required|min:2',
            'address' => 'required|min:2',
            'lga' => 'required|min:2',
            'state' => 'required|min:2',
            'user' => 'required',
        ];

        $request->validate($rules);

        $supermarket->name = $request->name;
        $supermarket->address = $request->address;
        $supermarket->lga = $request->lga;
        $supermarket->state = $request->state;
        $supermarket->user_id = $request->user;
        
        $supermarket->save();
        $result = $supermarket->isDirty();

        if ($request->ajax()) {
            if ($result) {
                return response()->json(['success' => 'Market Edited Successfully!']);
            }
            return response()->json(['info' => 'No Changes made!']);
        } else {
            if ($result) {
                return back()->with('success', 'Market Edited Successfully!');
            }
            return back()->with('success', 'No Changes made!');
        }
        return back()->with('error', 'Unable to Edit Market!');
    }
}

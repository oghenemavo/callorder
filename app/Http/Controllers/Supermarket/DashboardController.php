<?php

namespace App\Http\Controllers\Supermarket;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Merchant Area';
        $data['inventories'] = Inventory::where('supermarket_id', auth()->user()->supermarket->id)->get();
        return view('merchant.index', $data);
    }

    public function uploadInventory(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,xlsx,xlx,xls',
        ];
        $request->validate($rules);

        if ($request->hasfile('file')) {
            $result = DB::transaction(function () use($request) {
                $inventory = $request->file('file');
                $name = Str::of(auth()->user()->supermarket->name)->slug('_') . '_inventory_' . time() . '.' . $inventory->extension();
    
                $inventory->move(public_path('/inventory'), $name);
                $data['inventory_file'] = $name;
                $data['supermarket_id'] = auth()->user()->supermarket->id;

                Product::where('supermarket_id', auth()->user()->supermarket->id)->delete();
                
                Excel::import(new ProductsImport, public_path('/inventory/') . $name);

                return Inventory::create($data);
            });
            if ($result) {
                $request->session()->flash('primary', 'Inventory uploaded successfully!');
                if ($request->ajax()) {
                    return response()->json(['success' => true]);
                }
                return back();
            }
        }
        return back()->with('warning', 'Unable to upload inventory');
    }

    public function account()
    {
        $data['page_title'] = 'Account Settings';
        return view('merchant.settings.account', $data);
    }

    public function password(Request $request){
        $user = auth()->user();
        $rules = [
            'current' => [
                'required',
                function ($attribute, $value, $fail) use($user) {
                    $current_password = $user->password;
                    if (!Hash::check($value, $current_password)) {
                        $fail('This not the '. $attribute);
                    }
                },
            ],
            'password' => 'required|min:5',
            'repeat' => 'required|same:password',
        ];

        $attributes = [
            'current' => 'Current Password',
            'password' => 'New Password',
            'repeat' => 'Repeat Password',
        ];

        $request->validate($rules, [], $attributes);

        $user->password = Hash::make($request->password);
        $result = $user->save();
        if ($result) {
            return back()->with('message', 'Password Updated Successfully!');
        }
        return back()->with('message', 'Unable to Update Password!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin Dashboard';
        return view('admin.index', $data);
    }

    public function products()
    {
        $data['page_title'] = 'Store Products';
        return view('admin.products', $data);
    }

    public function orders()
    {
        $data['page_title'] = 'Customer Orders';
        $data['orders'] = Order::all();
        return view('admin.orders', $data);
    }
}

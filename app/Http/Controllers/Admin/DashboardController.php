<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin Dashboard';
        return view('admin.index', $data);
    }
}

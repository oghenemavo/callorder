<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Supermarket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin Dashboard';
        $sold_orders = Order::where('is_confirmed', '1')->count();
        $orders = Order::count();
        $users = User::count();
        $supermarkets = Supermarket::count();
        $start = Carbon::now();
        $period = [$start->firstOfMonth()->toDateTimeString(), $start->lastOfMonth()->toDateString() . ' 11:59:00'];

        $monthlyorderscollection = Order::whereBetween('created_at', $period)->orderBy('created_at', 'asc')->get(['created_at', 'total', 'id'])->groupBy(function($i) {
            return $i->created_at->format('d');
        });

        $monthlyrevenuecollection = Order::where('is_confirmed', '1')->whereBetween('created_at', $period)->orderBy('created_at', 'asc')->get(['created_at', 'total', 'id'])->groupBy(function($i) {
            return $i->created_at->format('d');
        });

        $data['order_chart'] = $monthlyorderscollection->map(fn($item, $key) => $item->sum('total'));

        $data['chart'] = $monthlyrevenuecollection->map(fn($item, $key) => $item->sum('total'));

        $data['monthlyrevenue'] = $data['chart']->reduce(fn($carry, $item) => $carry + $item);

        $data['sales'] = $sold_orders;
        $data['orders'] = $orders;
        $data['users'] = $users;
        $data['main_orders'] = Order::orderBy('id', 'desc')->get();
        $data['supermarkets'] = $supermarkets;
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

    public function fulfilment()
    {
        $data['page_title'] = 'Orders Fulfilment';
        $data['orders'] = Order::where('is_confirmed', '1')->orderBy('updated_at', 'ASC')->get();
        $data['page_title'] = 'Orders Fulfilment';
        return view('admin.orders_fulfilment', $data);
    }
}

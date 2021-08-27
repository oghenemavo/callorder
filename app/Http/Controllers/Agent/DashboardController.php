<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Agent\'s Dashboard';
        return view('agent.index', $data);
    }

    public function cart()
    {
        $data['page_title'] = 'Cart';
        $data['carts'] = Cart::where('user_id', auth()->user()->id)->get();
        $data['stock'] = function($supermarket_id, $product_name, $cart_max = 1) {
            $product = Product::where('supermarket_id', $supermarket_id)->where('product', $product_name)->first();
            return $product->quantity > $cart_max ? $product->quantity : $cart_max;
        };
        return view('agent.cart', $data);
    }

    public function orders()
    {
        $data['page_title'] = 'Orders';
        $data['orders'] = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('agent.orders', $data);
    }
    
    public function fulfilment()
    {
        $data['page_title'] = 'Orders Fulfilment';
        $data['orders'] = Order::where('user_id', auth()->user()->id)->where('is_confirmed', '1')->orderBy('updated_at', 'DESC')->get();
        $data['page_title'] = 'Fulfilment';
        return view('agent.orders_fulfilment', $data);
    }

    
}

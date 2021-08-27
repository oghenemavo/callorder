<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = auth()->user();
        $supermarket_id = $request->supermarket_id;
        $product = $request->product;
        $quantity = $request->quantity;
        $price = $request->price;

        $cart = Cart::where('user_id', $user->id)->where('supermarket_id', $supermarket_id)
            ->where('product', $product)->first();

        if ($cart) {
            if ($cart->quantity <= $quantity) {
                $cart->quantity += 1;
                $cart->save();
                return response()->json(['success' => 'Item appended to cart']);
            }
            return response()->json(['info' => 'Stock is Max']);
        } else {
            $data['user_id'] = $user->id;
            $data['supermarket_id'] = $supermarket_id;
            $data['product'] = $product;
            $data['price'] = $price;
            $data['quantity'] = 1;

            Cart::create($data);
            return response()->json(['success' => 'Item added to cart']);
        }
        return response()->json(['warning' => 'Unable to add to cart']);
    }

    public function updateCartItemQuantity(Request $request)
    {
        $user = auth()->user();
        $cart_id = $request->cart_id;
        $quantity = $request->quantity;

        $cart = Cart::where('id', $cart_id)->where('user_id', $user->id)->first();

        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
            return response()->json(['success' => 'Item appended to cart']);
        }
        return response()->json(['warning' => 'Unable to update cart item quantity']);
    }

    public function removeFromCart(Request $request)
    {
        $user = auth()->user();
        $supermarket_id = $request->supermarket_id;
        $product = $request->product;

        $cart = Cart::where('user_id', $user->id)->where('supermarket_id', $supermarket_id)
            ->where('product', $product)->first();

        if ($cart) {
            if ($cart->quantity == '1') {
                $cart->delete();
                return response()->json(['success' => 'Item Removed from cart']);
            } elseif($cart->first()->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();
                return response()->json(['success' => 'One Quantity of Item Removed from cart']);
            }
        }
        return response()->json(['warning' => 'Unable to remove Item from cart']);
    }

    public function deleteFromCart(Request $request)
    {
        $user = auth()->user();
        $cart_id = $request->cart_id;

        $cart = Cart::where('id', $cart_id)->where('user_id', $user->id)->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => 'Item Removed from cart']);
        }
        return response()->json(['warning' => 'Unable to remove Item from cart']);
    }

    public function emptyCart(Request $request)
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id);

        if ($cart) {
            $cart->delete();
            return response()->json(['success' => 'Cart emptied']);
        }
        return response()->json(['warning' => 'Unable to empty cart']);
    }

    public function createOrder(Request $request)
    {   
        $result = DB::transaction(function () use($request) {
            $user_id = auth()->user()->id;
            $cart = Cart::where('user_id', $user_id)->get();

            $total = $cart->map(fn($cart_item) => ($cart_item->quantity * $cart_item->price))->sum();

            $data = $request->all();
            $data['slug'] = $request->phone_number . '_' . bin2hex(random_bytes(20));
            $data['user_id'] = $user_id;
            $data['items'] = json_encode($cart);
            $data['total'] = $total;
    
            Order::create($data);
        
            return Cart::where('user_id', $user_id)->delete();
        });

        if ($result) {
            return redirect()->route('agent.orders')->with('success', 'Order Successfully Created');
        }
        return back()->with('error', 'Unable to create order');
    }

}

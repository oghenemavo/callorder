<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function products()
    {
        $products = Product::join('supermarkets', 'products.supermarket_id', 'supermarkets.id')
            ->get();
        
        return response()->json(['products' => $products]);
    }

    public function merchantProducts($supermarket_id)
    {
        $products = Product::where('supermarket_id', $supermarket_id)->get();
        
        return response()->json(['products' => $products]);
    }

    public function orders()
    {
        $products = Product::join('supermarkets', 'products.supermarket_id', 'supermarkets.id')
            ->get();
        
        return response()->json(['products' => $products]);
    }

    public function searchProduct($location, $product)
    {
        $products = Product::join('supermarkets', 'products.supermarket_id', 'supermarkets.id')
            ->where('supermarkets.lga', $location)->where('products.product', 'LIKE', "%{$product}%")->where('quantity', '>', '0')
            ->get(['supermarkets.*', 'products.*', 'products.id as product_id']);
        
        return response()->json(['products' => $products]);
    }

    public function addToCart(Request $request)
    {
        $quantity = $request->quantity;
        $product_id = $request->product_id;

        $product = Product::find($product_id);

        if(!empty($quantity)) {
            $itemArray = array(
                $product->id => array(
                    'id' => rand(1, 9999) . rand(0, 9),
                    'supermarket_id'  => $product->supermarket_id, 
                    'product'  => $product->product, 
                    'product_id'  => $product->id, 
                    'quantity'  => $quantity, 
                    'price' => $product->price, 
                )
            );

            if(session()->has('cart_item')) {
                if(in_array($product->id, array_keys(session()->get('cart_item')))) {
                    foreach(session()->get('cart_item') as $k => $v) {
                        if($product->id == $k) {
                            session()->put('cart_item.' . $product->id, $itemArray[$product->id]);
                            return response()->json(['primary' => 'Item Quantity added to cart']);
                        }
                    }
                } else {
                    session()->put('cart_item.' . $product->id, $itemArray[$product->id]);
                    return response()->json(['success' => 'Item added to cart']);
                }
            } else {
                session(['cart_item' => $itemArray]);
                return response()->json(['success' => 'Item added to cart']);
            }
        }
        return response()->json(['failed' => 'Unable to add to cart']);
    }

    public function getCart(Request $request)
    {
        return $request->session()->get('cart_item');
    }

    public function removeCartItem(Request $request)
    {
        $product_id = $request->product_id;

        if($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
            foreach($cart as $cart_key => $cart_value) {
                if($product_id == $cart_key)
                    $request->session()->forget('cart_item.' . $cart_key);
                    return response()->json(['success' => 'Item has been removed from cart']);				
                if(empty($_SESSION["cart_item"]))
                    $request->session()->forget('cart_item');
            }
        }
        return true;
    }

    public function deleteCart()
    {
        unset($_SESSION["cart_item"]);
        return true;
    }

}

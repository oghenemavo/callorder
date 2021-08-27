<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AjaxController extends Controller
{
    public function products()
    {
        $products = Product::join('supermarkets', 'products.supermarket_id', 'supermarkets.id')
            ->get();
        
        return response()->json(['products' => $products]);
    }

    public function orders()
    {
        $products = Product::join('supermarkets', 'products.supermarket_id', 'supermarkets.id')
            ->get();
        
        return response()->json(['products' => $products]);
    }
}

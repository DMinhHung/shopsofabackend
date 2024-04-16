<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}

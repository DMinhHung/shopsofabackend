<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // GET all orders
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    // POST a new order
    public function store(Request $request)
    {
        Log::info('Checking request data:', $request->all());
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,id',
            'productIds' => 'required|array',
            'productIds.*' => 'exists:products,id',
            'date' => 'required|date',
        ]);
        $date = Carbon::parse($validatedData['date'])->toDateString();
        Log::info('Validated data:', $validatedData);
        $orderCode = Str::random(9);
        $order = new Order([
            'maorder' => $orderCode,
            'userId' => $validatedData['userId'],
            'date' => $date,
        ]);
        $order->save();

        $orderProductsData = [];
        foreach ($validatedData['productIds'] as $productId) {
            $orderProductsData[] = [
                'order_id' => $order->id,
                'product_id' => $productId,
            ];
        }

        OrderProduct::insert($orderProductsData);
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}

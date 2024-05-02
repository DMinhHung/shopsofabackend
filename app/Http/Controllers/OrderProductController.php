<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;


class OrderProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $validatedData['order_id'];
            $orderProduct->product_id = $validatedData['product_id'];

            $orderProduct->save();

            return response()->json(['message' => 'OrderProduct created successfully', 'orderProduct' => $orderProduct], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create OrderProduct', 'error' => $e->getMessage()], 500);
        }
    }
}

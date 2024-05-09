<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShoppingCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // GET all orders
    public function index()
    {
        try {
            // Sử dụng join để kết hợp các bảng và lấy thông tin cần thiết
            $orders = DB::table('order')
                ->join('order_product', 'order.id', '=', 'order_product.order_id')
                ->join('users', 'order.userId', '=', 'users.id')
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->select(
                    'order.id as order_id',
                    'order.maorder as order_code',
                    'order.date as order_date',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.address as user_address',
                    'products.id as product_id',
                    'products.name as product_name',
                    'products.price as product_price',
                    'products.image as product_image'
                )
                ->get();

            // Trả về dữ liệu dưới dạng JSON
            return response()->json(['message' => 'Successfully retrieved orders with related user and products', 'orders' => $orders], 200);
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có lỗi xảy ra
            return response()->json(['message' => 'Failed to retrieve orders with related user and products', 'error' => $e->getMessage()], 500);
        }
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

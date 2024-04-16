<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::join('products', 'shoppingcart.productId', '=', 'products.id')
            ->select('shoppingcart.*', 'products.name', 'products.image', 'products.price')
            ->get();

        return response()->json($cartItems);
    }
    public function addToCart(Request $request)
    {
        // Validate request
        $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        try {
            $productId = $request->input('productId');
            $quantity = $request->input('quantity');

            $product = Product::findOrFail($productId);

            ShoppingCart::create([
                'productId' => $productId,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
            ]);

            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add product to cart', 'error' => $e->getMessage()], 500);
        }
    }
    public function updateCart(Request $request)
    {
        try {
            $cartItems = $request->input('cartItems');

            foreach ($cartItems as $cartItem) {
                $id = $cartItem['id'];
                $quantity = $cartItem['quantity'];

                $shoppingCart = ShoppingCart::findOrFail($id);

                // Lấy thông tin sản phẩm từ bảng Products
                $product = Product::findOrFail($shoppingCart->productId);

                // Cập nhật số lượng và tổng giá trị của mỗi mục giỏ hàng
                $shoppingCart->quantity = $quantity;
                $shoppingCart->total = $product->price * $quantity;
                $shoppingCart->save();
            }

            return response()->json(['message' => 'Cart updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update cart', 'error' => $e->getMessage()], 500);
        }
    }
    public function deleteFromCart($id)
    {
        $cartItem = ShoppingCart::findOrFail($id);

        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    // Hiển thị danh sách sản phẩm dưới dạng API
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Lưu sản phẩm mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'imagep1' => 'nullable|image',
            'imagep2' => 'nullable|image',
            'imagep3' => 'nullable|image',
            'imagep4' => 'nullable|image',
            'sizepd' => 'nullable|string',
            'colorpd' => 'nullable|string',
            'materialpd' => 'nullable|string',
            'warrantypd' => 'nullable|string',
            'advantage' => 'nullable|string',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        $additionalImagePaths = [];
        foreach (['imagep1', 'imagep2', 'imagep3', 'imagep4'] as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $additionalImagePaths[$field] = 'images/' . $imageName;
            }
        }


        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'imagep1' => $additionalImagePaths['imagep1'] ?? null,
            'imagep2' => $additionalImagePaths['imagep2'] ?? null,
            'imagep3' => $additionalImagePaths['imagep3'] ?? null,
            'imagep4' => $additionalImagePaths['imagep4'] ?? null,
            'sizepd' => $request->sizepd,
            'colorpd' => $request->colorpd,
            'materialpd' => $request->materialpd,
            'warrantypd' => $request->warrantypd,
            'advantage' => $request->advantage,
        ]);

        return response()->json($product, 201);
    }

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh chính cũ (nếu có)
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $product->image = 'images/' . $imageName;
        }

        // Xóa các ảnh phụ cũ (nếu có)
        foreach (['imagep1', 'imagep2', 'imagep3', 'imagep4'] as $field) {
            if ($request->hasFile($field)) {
                if ($product->{$field}) {
                    Storage::delete($product->{$field});
                }
                $image = $request->file($field);
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $product->{$field} = 'images/' . $imageName;
            } elseif ($request->input($field) === null) {
                if ($product->{$field}) {
                    Storage::delete($product->{$field});
                    $product->{$field} = null;
                }
            }
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'sizepd' => $request->sizepd,
            'colorpd' => $request->colorpd,
            'materialpd' => $request->materialpd,
            'warrantypd' => $request->warrantypd,
            'advantage' => $request->advantage,
        ]);

        return response()->json($product);
    }


    // Xóa sản phẩm khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh chính nếu có
        if ($product->image) {
            $imagePath = public_path($product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Xóa ảnh phụ nếu có
        foreach (['imagep1', 'imagep2', 'imagep3', 'imagep4'] as $field) {
            if ($product->$field) {
                $imagePath = public_path($product->$field);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $product->delete();

        return response()->json(null, 204);
    }
}

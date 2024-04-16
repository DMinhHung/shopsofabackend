<?php

namespace App\Http\Controllers;

use App\Models\Ourteam;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index()
    {
        $products = Ourteam::all();
        return response()->json($products);
    }

    // Lưu sản phẩm mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $product = Ourteam::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return response()->json($product, 201);
    }

    // Hiển thị thông tin sản phẩm cụ thể dưới dạng API
    public function show($id)
    {
        $product = Ourteam::findOrFail($id);
        return response()->json($product);
    }

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $product = Ourteam::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return response()->json($product);
    }

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $product = Ourteam::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}

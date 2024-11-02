<?php

namespace App\Http\Controllers;
use App\Models\Category; // Thêm dòng này

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::all();
        return response()->json([$userId,$categories]);
    }

    // Thêm danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($category, 201); // Trả về danh mục mới với mã 201
    }

    // Xóa danh mục
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete(); // Xóa danh mục
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}

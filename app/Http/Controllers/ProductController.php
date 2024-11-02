<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        //
        $product = Product::all();

         return response()->json([
            'status'=>true,
            'data'=>$product,
            'message'=>'Lấy ra sản phẩm thành công!'


         ]);

    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $imagePath = $request->file('image')->store('images', 'public');
        $imageData = file_get_contents(storage_path("app/public/{$imagePath}"));
        $base64Image = base64_encode($imageData);

        $product = Product::create(array_merge($request->all(), ['image' => $base64Image]));

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Sản phẩm đã được thêm thành công!'
        ], 201);
    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại!'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Lấy ra sản phẩm thành công!'
        ]);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại!'], 404);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'categories_id' => 'sometimes|required|exists:categories,id',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $data = $request->all();


        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $base64Image = base64_encode(file_get_contents($image->getRealPath()));
            $data['image'] = $base64Image;
        } else {

            $data['image'] = $product->image;
        }

        $product->update($data);

        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Sản phẩm đã được cập nhật thành công!'
        ]);
    }





    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status' => true,
            'data' => $product,
            'message' => 'Đã xóa thành công'
        ]);
    }
}

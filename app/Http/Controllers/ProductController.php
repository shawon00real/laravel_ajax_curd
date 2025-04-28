<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->paginate(5);
        return view('welcome', compact('products'));
    }
    public function addProduct(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json($product);
    }

    public function editProduct(Request $request){
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json($product);
    }
    public function deleteProduct(Request $request){
        $deletePruduct = Product::find($request->id);
        $deletePruduct->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}

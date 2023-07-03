<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsList()
    {
        $products = Product::all()->sortBy('name');
        return view('products.index', [
            "products" => $products,
        ]);
    }

    public function createProduct()
    {
        return view('products.create');
    }

    public function storeProduct(Request $request)
    {
        Product::create($request->all());

        return redirect()->route("products.list");
    }
    public function editProduct($productId)
    {
        $product = Product::find($productId);

        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function updateProduct(Request $request, $productId)
    {
        $product = Product::find($productId);
        $product->update($request->all()); 

        return redirect()->route("products.list");
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        $product->delete();

        return back();
    }

}

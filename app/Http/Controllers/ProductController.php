<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /* function to get all products */
    public function index()
    {
        return $products = Product::query()->latest()->get();
    }

    /* function to create new product */
    public function store(ProductRequest $request)
    {
       Product::create($request->validated());

        return response()->json('Product created!');
    }

    /* function to get single product detail */
    public function show( $id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    /* function to update single product detail */
    public function update(Product $id, ProductRequest $request)
    {
        $product = $id;
        $product->update($request->validated());
        return response()->json('Product updated!');
    }

    /* function to delete single product */
    public function destroy($id)
    {

        $product = Product::find($id);
        $product->delete();
        return response()->json('Product deleted!');
    }
}

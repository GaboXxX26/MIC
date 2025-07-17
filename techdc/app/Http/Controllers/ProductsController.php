<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new product
        $product = product::create($request->all());

        // Return the created product as a JSON response
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        // Return the product with its category as a JSON response
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        // Return the updated product as a JSON response
        return response()->json($product, 200);
    }

    public function destroy(product $product)
    {
        $product->delete();

        // Return a success response
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}

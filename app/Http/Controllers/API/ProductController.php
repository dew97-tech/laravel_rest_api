<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(Product::all(), 200);
        }
        $search = $request->input('search');

        if ($search) {
            $products = Product::search($search)->paginate(5);
        } else {
            $products = Product::with('category', 'attributes')->paginate(5);
        }

        return view('products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('products.create', compact('categories', 'attributes'));
    }
    // app/Http/Controllers/API/ProductController.php

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'array',
            'attributes.*' => 'nullable|string',
        ]);

        if ($request->expectsJson()) {
            // Create product
            $product = Product::create($request->only('name', 'category_id'));

            // Retrieve attributes
            $attributes = $request->input('attributes', []);

            // Attach attributes to the product
            foreach ($attributes as $attributeId => $value) {
                if ($value !== null) {
                    $product->attributes()->attach($attributeId, ['value' => $value]);
                }
            }
            // Return a JSON response for API requests
            return response()->json([
                'message' => 'Product created successfully.',
                'product' => new ProductResource($product->load('attributes')),
            ], 201); // 201 Created status code
        }

        // Create product
        $product = Product::create($request->only('name', 'category_id'));

        // Retrieve attributes
        $attributes = $request->input('attributes', []);

        // Attach attributes to the product
        foreach ($attributes as $attributeId => $value) {
            if ($value !== null) {
                $product->attributes()->attach($attributeId, ['value' => $value]);
            }
        }

        // Redirect to the products index page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function show(Product $product)
    {
        return new ProductResource($product->load('attributes'));
    }

    public function edit($id)
    {
        $product = Product::with('attributes')->findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('products.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'array',
            'attributes.*' => 'nullable|string',
        ]);

        // Update product
        $product->update($validatedData);

        // Detach existing attributes
        $product->attributes()->detach();

        // Attach updated attributes to the product
        $attributes = $request->input('attributes', []);
        foreach ($attributes as $attributeId => $value) {
            if ($value !== null) {
                $product->attributes()->attach($attributeId, ['value' => $value]);
            }
        }

        if ($request->expectsJson()) {
            // Return a JSON response for API requests
            return response()->json([
                'message' => 'Product updated successfully.',
                'product' => new ProductResource($product->load('attributes')),
            ], 200);
        }

        // Redirect to the products index page with a success message for web requests
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }





    public function destroy(Product $product)
    {
        $productName = $product->name;

        // Delete the product
        $product->delete();

        if (request()->expectsJson()) {
            // Return a JSON response for API requests
            return response()->json([
                'message' => "Product '{$productName}' deleted successfully.",
            ], 200);
        }

        // Redirect to the products index page with a success message for web requests
        return redirect()->route('products.index')->with('success', "Product '{$productName}' deleted successfully.");
    }

}

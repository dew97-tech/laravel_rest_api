<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $categories = Category::all();
            return CategoryResource::collection($categories);
        }
        //   Implement with search and return the categories
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->paginate(10);

        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($request->expectsJson()) {
            // Create the category
            $category = Category::create($request->all());
            // Return a JSON response for API requests
            return response()->json([
                'message' => 'Category created successfully.',
                'category' => new CategoryResource($category),
            ], 201); // 201 Created status code
        }

        // Create the category
        Category::create($request->all());

        // Redirect to the categories index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // if it's an API request, return a JSON response
        if ($request->expectsJson()) {
            $category->update($request->all());
            return response()->json([
                'message' => 'Category updated successfully.',
                'category' => new CategoryResource($category),
            ]);
        }

        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category, Request $request)
    {
        // immediately delete the category and return to the index page
        $category->delete();
        // if it's an API request, return a JSON response with its category name and a success message
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Category deleted successfully.',
                'category' => $category->name,
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Http\Resources\AttributeResource;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // if request is expecting JSON response, return all attributes
        if ($request->expectsJson()) {
            $attributes = Attribute::all();
            return AttributeResource::collection($attributes);
        }
        $attributes = Attribute::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })->paginate(10);

        return view('attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // if request is expecting JSON response, create the attribute and return a JSON response
        if ($request->expectsJson()) {
            $attribute = Attribute::create($request->all());
            return response()->json([
                'message' => 'Attribute created successfully.',
                'attribute' => new AttributeResource($attribute),
            ], 201);
        }

        Attribute::create($request->all());

        return redirect()->route('attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function show(Attribute $attribute)
    {
        return new AttributeResource($attribute);
    }

    public function edit(Attribute $attribute)
    {
        return view('attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // if it's an API request, return a JSON response
        if ($request->expectsJson()) {
            $attribute->update($request->all());
            return response()->json([
                'message' => 'Attribute updated successfully.',
                'attribute' => new AttributeResource($attribute),
            ]);
        }

        $attribute->update($request->all());

        return redirect()->route('attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        // if it's an API request, return a JSON response with its attribute name and a success message
        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Attribute deleted successfully.',
                'attribute' => $attribute->name,
            ]);
        }

        return redirect()->route('attributes.index')->with('success', 'Attribute deleted successfully.');
    }

}

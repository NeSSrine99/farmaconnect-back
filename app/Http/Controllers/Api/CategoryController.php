<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('products')->get();
    }

    public function store(Request $request)
    {
        $category = Category::create($request->validate([
            'name' => 'required|string'
        ]));

        return response()->json($category, 201);
    }

    public function show($id)
    {
        return Category::with('products')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}

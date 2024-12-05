<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category = Category::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Category retrieved successfully',
            'data' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
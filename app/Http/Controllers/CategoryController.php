<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return Category::with('user')
            ->orderBy('name')
            ->get();
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|exists:users,id',
            'name'   => 'required|string|max:255',
            'type'   => 'required|string|in:income,expense',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function getCategory($id)
    {
        $category = Category::with(['user', 'transactions', 'budgets'])
            ->findOrFail($id);

        return response()->json($category);
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'userId' => 'sometimes|exists:users,id',
            'name'   => 'sometimes|string|max:255',
            'type'   => 'sometimes|string|in:income,expense',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return response()->json($category);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}

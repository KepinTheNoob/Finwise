<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        $categories = Category::where('user_id', $request->user()->id)
            ->withCount('transactions')
            ->orderBy('name')
            ->get();

        return view('categories', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|exists:users,id',
            'name'   => 'required|string|max:255',
            'type'   => 'required|string|in:income,expense',
            'color'  => 'required|regex:/^#([a-f0-9]{6})$/i',
        ]);

        $category = Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    // public function getCategory($id)
    // {
    //     $category = Category::with(['user', 'transactions', 'budgets'])
    //         ->findOrFail($id);

    //     return response()->json($category);
    // }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'userId' => 'sometimes|exists:users,id',
            'name'   => 'sometimes|string|max:255',
            'type'   => 'sometimes|string|in:income,expense',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}

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
            'name'  => 'required|string|max:255',
            'type'  => 'required|string|in:Income,Expense', 
            'color' => 'required|regex:/^#([a-f0-9]{6})$/i',
        ]);
        
        $category = $request->user()->categories()->create($validated);

        return response()->json($category->loadCount('transactions'), 201);
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
            'name'  => 'sometimes|string|max:255',
            'type'  => 'sometimes|string|in:Income,Expense',
            'color' => 'sometimes|regex:/^#([a-f0-9]{6})$/i',
        ]);

        $category = Category::where('user_id', $request->user()->id)->findOrFail($id);
        $category->update($validated);

        // Return the updated object as JSON
        return response()->json($category->loadCount('transactions'));
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = Category::where('user_id', $request->user()->id)->findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}

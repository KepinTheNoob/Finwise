<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function getBudgets()
    {
        return Budget::with(['user', 'category'])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    }

    public function createBudget(Request $request)
    {
        $validated = $request->validate([
            'userId'      => 'required|exists:users,id',
            'categoryId'  => 'required|exists:categories,id',
            'month'       => 'required|integer|min:1|max:12',
            'year'        => 'required|integer|min:2000|max:2100',
            'amount_limit'=> 'required|numeric|min:0',
        ]);

        $budget = Budget::create($validated);

        return response()->json($budget, 201);
    }

    public function getBudget($id)
    {
        $budget = Budget::with(['user', 'category'])
            ->findOrFail($id);

        return response()->json($budget);
    }

    public function updateBudget(Request $request, $id)
    {
        $validated = $request->validate([
            'userId'      => 'sometimes|exists:users,id',
            'categoryId'  => 'sometimes|exists:categories,id',
            'month'       => 'sometimes|integer|min:1|max:12',
            'year'        => 'sometimes|integer|min:2000|max:2100',
            'amount_limit'=> 'sometimes|numeric|min:0',
        ]);

        $budget = Budget::findOrFail($id);
        $budget->update($validated);

        return response()->json($budget);
    }

    public function destroyBudget($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return response()->json(['message' => 'Budget deleted successfully']);
    }
}

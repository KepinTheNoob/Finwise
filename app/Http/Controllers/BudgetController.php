<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function getBudgets(Request $request)
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->get();

        $budgetsData = Budget::with('category')
            ->where('user_id', $userId)
            ->get();

        $budgets = $budgetsData->map(function ($budget) use ($userId) {
            $spent = Transaction::where('user_id', $userId)
                ->where('category_id', $budget->category_id)
                ->where('type', 'expense')
                ->whereMonth('transaction_date', date('m')) 
                ->whereYear('transaction_date', date('Y'))
                ->sum('amount');

            return [
                'id'          => $budget->id,
                'category_id' => $budget->category_id,
                'category'    => $budget->category->name ?? 'Unknown',
                'limit'       => (float) $budget->amount,
                'spent'       => (float) $spent,
                'period'      => $budget->period,
            ];
        });

        return view('budgets', [
            'budgets'    => $budgets,
            'categories' => $categories,
            'currency'   => auth()->user()->currency ?? 'IDR',
        ]);
    }

    public function createBudget(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'period'      => 'required|string|in:Monthly,Weekly,Yearly'
        ]);

        $exists = Budget::where('user_id', auth()->id())
            ->where('category_id', $validated['category_id'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Budget for this category already exists'], 422);
        }

        auth()->user()->budgets()->create($validated);

        return response()->json(['message' => 'Budget created successfully']);
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
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'period'      => 'required|string|in:Monthly,Weekly,Yearly'
        ]);

        $budget = auth()->user()->budgets()->findOrFail($id);
        
        $budget->update($validated);

        return response()->json(['message' => 'Budget updated successfully']);
    }

    public function deleteBudget($id)
    {
        $budget = Budget::where('user_id', Auth::id())->findOrFail($id);
        $budget->delete();

        return response()->json(['message' => 'Budget deleted']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;

class TransactionController extends Controller
{
    function getTransactions(Request $request) {
        $transactions = Transaction::where('user_id', $request->user()->id)
            ->with('category')
            ->orderBy('transaction_date', 'desc')
            ->get();

        $categories = Category::where('user_id', $request->user()->id)->get();

        return view('transactions', compact('transactions', 'categories'));
    }

    function createTransactions(Request $request) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount'      => 'required|numeric|min:0',
            'type'        => 'required|in:income,expense,Income,Expense',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction = Transaction::create([
            'user_id'     => Auth::id(),
            'category_id' => $validated['category_id'],
            'amount'      => $validated['amount'],
            'type'        => strtolower($validated['type']),
            'description' => $validated['description'] ?? null,
            'transaction_date' => $validated['transaction_date'],
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction created successfully');
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::with(['user', 'category'])->findOrFail($id);
        return view('transactions', compact('transaction'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'category_id' => 'sometimes|exists:categories,id',
            'amount' => 'sometimes|numeric',
            'type' => 'sometimes|string|in:income,expense',
            'description' => 'nullable|string',
            'transaction_date' => 'sometimes|date',
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully');
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully');
    }
}

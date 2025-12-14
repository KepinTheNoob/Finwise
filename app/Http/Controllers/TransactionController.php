<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    function getTransactions(Request $request) {
        $transactions = Transaction::where("userId", $request->user()->id)
            ->with("category")
            ->orderBy("transactionDate", "desc")
            ->get();

        return response()->json($transaction);
    }

    function createTransactions(Request $request) {
        $validated = $request->validate([
            'userId' => 'required|exists:users,id',
            'categoryId' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense',
            'description' => 'nullable|string',
            'transactionDate' => 'required|date',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json($transaction, 201);
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::with(['user', 'category'])->findOrFail($id);
        return response()->json($transaction);
    }

    public function updateTransaction(Request $request, $id)
    {
        $validated = $request->validate([
            'userId' => 'sometimes|exists:users,id',
            'categoryId' => 'sometimes|exists:categories,id',
            'amount' => 'sometimes|numeric',
            'type' => 'sometimes|string|in:income,expense',
            'description' => 'nullable|string',
            'transactionDate' => 'sometimes|date',
        ]);

        $transaction = Transaction::findOrFail($id);

        $transaction->update($validated);

        return response()->json($transaction);
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted']);
    }
}

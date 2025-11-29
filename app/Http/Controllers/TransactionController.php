<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function income(Request $request)
    {
        $query = Transaction::where('type', 'income')->with(['category', 'account', 'user']);
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->byDateRange($request->start_date, $request->end_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(10);
        $totalIncome = Transaction::where('type', 'income')->sum('amount');

        return view('transactions.income', compact('transactions', 'totalIncome'));
    }

    public function expense(Request $request)
    {
        $query = Transaction::where('type', 'expense')->with(['category', 'account', 'user']);
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->byDateRange($request->start_date, $request->end_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(10);
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');

        return view('transactions.expense', compact('transactions', 'totalExpense'));
    }

    public function create()
    {
        $categories = Category::all();
        $accounts = Account::all();
        return view('transactions.create', compact('categories', 'accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'account_id' => 'required|exists:accounts,id',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        Transaction::create($validated);

        $redirectRoute = $validated['type'] === 'income' ? 'transactions.income' : 'transactions.expense';
        return redirect()->route($redirectRoute)->with('success', 'Transaction created successfully');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        $accounts = Account::all();
        return view('transactions.edit', compact('transaction', 'categories', 'accounts'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'account_id' => 'required|exists:accounts,id',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction->update($validated);

        $redirectRoute = $validated['type'] === 'income' ? 'transactions.income' : 'transactions.expense';
        return redirect()->route($redirectRoute)->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $type = $transaction->type;
        $transaction->delete();
        
        $redirectRoute = $type === 'income' ? 'transactions.income' : 'transactions.expense';
        return redirect()->route($redirectRoute)->with('success', 'Transaction deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        $query = Debt::query()->with('user');
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $debts = $query->orderBy('due_date', 'desc')->paginate(10);
        $totalDebt = Debt::where('type', 'debt')->sum('amount');
        $totalReceivable = Debt::where('type', 'receivable')->sum('amount');

        return view('debts.index', compact('debts', 'totalDebt', 'totalReceivable'));
    }

    public function create()
    {
        return view('debts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:debt,receivable',
            'party_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        Debt::create($validated);

        return redirect()->route('debts.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Debt $debt)
    {
        return view('debts.edit', compact('debt'));
    }

    public function update(Request $request, Debt $debt)
    {
        $validated = $request->validate([
            'type' => 'required|in:debt,receivable',
            'party_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue',
            'description' => 'nullable|string',
        ]);

        $debt->update($validated);

        return redirect()->route('debts.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();
        return redirect()->route('debts.index')->with('success', 'Data berhasil dihapus');
    }
}

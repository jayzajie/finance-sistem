<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total users
        $totalUsers = User::where('status', 'active')->count();

        // Get total income (Kas Masuk)
        $totalIncome = Transaction::where('type', 'income')->sum('amount');

        // Get total expense (Kas Keluar)
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');

        // Get final balance (Saldo Akhir)
        $finalBalance = Account::sum('balance');

        // Get income breakdown by category with percentages
        $incomeBreakdown = Transaction::where('type', 'income')
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) use ($totalIncome) {
                return [
                    'category' => $item->category->name,
                    'amount' => $item->total,
                    'percentage' => $totalIncome > 0 ? round(($item->total / $totalIncome) * 100) : 0,
                    'color' => $item->category->color,
                ];
            });

        // Get expense breakdown by category with percentages
        $expenseBreakdown = Transaction::where('type', 'expense')
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get()
            ->map(function ($item) use ($totalExpense) {
                return [
                    'category' => $item->category->name,
                    'amount' => $item->total,
                    'percentage' => $totalExpense > 0 ? round(($item->total / $totalExpense) * 100) : 0,
                    'color' => $item->category->color,
                ];
            });

        return view('dashboard', compact(
            'totalUsers',
            'totalIncome',
            'totalExpense',
            'finalBalance',
            'incomeBreakdown',
            'expenseBreakdown'
        ));
    }
}

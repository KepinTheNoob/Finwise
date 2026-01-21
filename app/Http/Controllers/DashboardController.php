<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $userId = Auth::id();

        $latestTransaction = Transaction::where('user_id', $userId)->max('transaction_date');
        
        $latestTs  = $latestTransaction ? strtotime($latestTransaction) : time();
        $currentTs = time();

        $anchorTs = ($latestTs > $currentTs) ? $latestTs : $currentTs;

        $currentMonth = date('m', $anchorTs);
        $currentYear  = date('Y', $anchorTs);

        $lastMonthTs  = strtotime('first day of last month', $anchorTs);
        $lastMonth    = date('m', $lastMonthTs);
        $lastYear     = date('Y', $lastMonthTs);
        
        $currentIncome = $this->getSum($userId, 'income', $currentMonth, $currentYear);
        $lastIncome    = $this->getSum($userId, 'income', $lastMonth, $lastYear);
        $incomeTrend   = $this->calculateTrend($currentIncome, $lastIncome);

        $currentExpense = $this->getSum($userId, 'expense', $currentMonth, $currentYear);
        $lastExpense    = $this->getSum($userId, 'expense', $lastMonth, $lastYear);
        $expenseTrend   = $this->calculateTrend($currentExpense, $lastExpense);

        $currentNet = $currentIncome - $currentExpense;
        $lastNet    = $lastIncome - $lastExpense;
        $netTrend   = $this->calculateTrend($currentNet, $lastNet);

        $recentTransactions = Transaction::where('user_id', $userId)
            ->with('category')
            ->latest('transaction_date')
            ->take(5)
            ->get();

        $chartData = [];
        $chartCategories = [];

        for ($i = 5; $i >= 0; $i--) {
            $timestamp = strtotime("first day of -$i months", $anchorTs);
            
            $m = date('m', $timestamp);
            $y = date('Y', $timestamp);
            $label = date('M', $timestamp);

            $inc = $this->getSum($userId, 'income', $m, $y);
            $exp = $this->getSum($userId, 'expense', $m, $y);

            $chartData[] = (int) $inc;
            $chartCategories[] = $label; 

            $chartData[] = (int) -($exp);
            $chartCategories[] = 'Exp';
        }

        return view('dashboard', compact(
            'currentIncome', 'incomeTrend',
            'currentExpense', 'expenseTrend',
            'currentNet', 'netTrend',
            'recentTransactions',
            'chartData', 'chartCategories'
        ));
    }

    private function getSum($userId, $type, $month, $year)
    {
        return Transaction::where('user_id', $userId)
            ->where('type', $type)
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year)
            ->sum('amount');
    }

    private function calculateTrend($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / abs($previous)) * 100, 1);
    }
}
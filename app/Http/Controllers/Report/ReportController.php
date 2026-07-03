<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function categoryWiseExpense(Request $request)
    {
        $selectedMonth = $request->input('month') ?? (int) date('m');
        $selectedYear = $request->input('year') ??  date('Y');
        $selectedCategory = $request->input('category');

        $allCategories = Category::all();

        $categories = Category::withSum(['expenses as total' => function ($query) use ($selectedMonth, $selectedYear) {
            $query->where('user_id', auth()->id())
                ->whereMonth('spent_at', $selectedMonth)
                ->whereYear('spent_at', $selectedYear);
        }], 'amount')->orderBy('name', 'asc');

        if ($selectedCategory) {
            $categories->where('id', $selectedCategory);
        }

        $categories = $categories->get();

        return view(
            'report.total-expense-category-wise',
            compact(
                'allCategories',
                'categories',
                'selectedMonth',
                'selectedYear',
                'selectedCategory'
            )
        );
    }

    public function averageDailyExpenses(Request $request)
    {
        $selectedMonth = $request->input('month') ?? (int) date('m');
        $selectedYear = $request->input('year') ??  date('Y');

        $allExpenses = auth()->user()->expenses()
            ->select(
                DB::raw('DATE(spent_at) as spent_at'),
                DB::raw('SUM(amount) as total'),
                DB::raw('COUNT(DATE(spent_at)) as count'),
            )
            ->whereMonth('spent_at', $selectedMonth)
            ->whereYear('spent_at', $selectedYear)
            ->groupBy(DB::raw('DATE(spent_at)'))
            ->orderBy('spent_at')
            ->get();

        $totalMonthlyExpense = $allExpenses->pluck('total')->sum();

        $daysInMonth = Carbon::create($selectedYear, $selectedMonth)->daysInMonth;

        $averageDailySpent = $totalMonthlyExpense / $daysInMonth;

        return view(
            'report.average-daily-expense',
            compact(
                'selectedMonth',
                'selectedYear',
                'allExpenses',
                'averageDailySpent',
            )
        );
    }
}

<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function categoryWiseExpense(Request $request)
    {
        $selectedMonth = $request->input('month') ?? date('m');
        $selectedYear = $request->input('year') ??  date('Y');

        $categories = Category::orderBy('name', 'asc')->get();

        $categoryNames = $categories->pluck('name')->toArray();

        // Total Expenses Per Category
        $monthlyExpensesPerCategory = [];

        $maxMonthlyExpensePerCategory = 0;

        foreach ($categories as $category) {
            $totalExpenses = auth()->user()->expenses()
                ->where('category_id', $category->id)
                ->whereMonth('spent_at', $selectedMonth)
                ->whereYear('spent_at', $selectedYear)
                ->sum('amount');

            if ($totalExpenses > $maxMonthlyExpensePerCategory) {
                $maxMonthlyExpensePerCategory = $totalExpenses;
            }

            array_push($monthlyExpensesPerCategory, $totalExpenses);
        }

        $categories = Category::withSum(['expenses as total' => function ($query) {
            $query->where('user_id', auth()->id())
                ->whereMonth('spent_at', now()->month)
                ->whereYear('spent_at', now()->year);
        }], 'amount')->orderBy('name', 'asc')->get();

        return view(
            'report.total-expense-category-wise',
            compact(
                'categoryNames',
                'monthlyExpensesPerCategory',
                'maxMonthlyExpensePerCategory',
                'categories',
                'selectedMonth',
                'selectedYear'
            )
        );
    }
}

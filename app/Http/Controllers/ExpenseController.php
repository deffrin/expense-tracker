<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('category')->paginate(20);

        return view('expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('expense.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        Expense::create([
            'user_id' =>  Auth::user()->id,
            'amount' => $validated['amount'],
            'added_date' => $validated['date'],
            'description' => $validated['description'] ?? '',
            'category_id' => $validated['category'],
        ]);

        return redirect('/my-expenses');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);

        $categories = Category::all();

        return view('expense.edit', compact('categories', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $expense->update([
            'amount' => $validated['amount'],
            'added_date' => $validated['date'],
            'description' => $validated['description'] ?? '',
            'category_id' => $validated['category'],
        ]);

        return redirect('/my-expenses');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);

        $expense->delete();

        return redirect('/my-expenses');
    }
}

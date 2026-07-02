<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/my-expenses', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/add-expense', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/store-expense', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('/edit-expense/{expense}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::post('/update-expense/{expense}', [ExpenseController::class, 'update'])->name('expense.update');

});

require __DIR__.'/auth.php';

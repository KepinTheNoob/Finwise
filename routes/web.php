<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return redirect('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/transactions', [TransactionController::class, 'getTransactions'])
    ->name('transactions.index');

Route::post('/transactions', [TransactionController::class, 'createTransactions'])
    ->name('transactions.store');

Route::get('/transactions/{id}', [TransactionController::class, 'getTransaction'])
    ->name('transactions.show');

Route::post('/transactions/{id}/update', [TransactionController::class, 'updateTransaction'])
    ->name('transactions.update');

Route::post('/transactions/{id}/delete', [TransactionController::class, 'deleteTransaction'])
    ->name('transactions.destroy');

Route::get('/categories', [CategoryController::class, 'getCategories'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'createCategories'])->name('categories.store');
Route::put('/categories/{id}', [CategoryController::class, 'updateCategory'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'deleteCategory'])->name('categories.destroy');

// Route::get('/budgets', [BudgetController::class, 'getBudgets']);
// Route::post('/budgets', [BudgetController::class, 'createBudgets']);
// Route::get('/budgets/{id}', [BudgetController::class, 'getBudget']);
// Route::put('/budgets/{id}', [BudgetController::class, 'updateBudget']);
// Route::delete('/budgets/{id}', [BudgetController::class, 'deleteBudget']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/budgets', function () {
    return view('budgets');
})->name('budgets');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
Route::get('/transactions', fn() => view('transactions'))->name('transactions.index');
Route::get('/categories', fn() => view('categories'))->name('categories.index');
Route::get('/budgets', fn() => view('budgets'))->name('budgets.index');
Route::get('/profile', fn() => view('profile'))->name('profile');

Route::resource('categories', CategoryController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('budgets', BudgetController::class);

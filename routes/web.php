<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VNPayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/filter', [CategoryController::class, 'filter'])->name('category.filter');

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{course}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{course}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
    Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
});
// Route::post('/vnpay/ipn', [VNPayController::class, 'ipn'])->name('vnpay.ipn');
//GET ERROR WHEN PLACING THESE ROUTE
// Route::middleware(['auth'])->group(function () {
//     Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
//     Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
// });

Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
require __DIR__ . '/auth.php';
Route::get('/courses/search', [CourseController::class, 'search'])->name('course.search');

<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\VNPayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\OrderController;

// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::redirect('/', '/admin/courses')->name('admin.dashboard');
//     Route::resource('courses', AdminCourseController::class)->names('admin.courses');
//     Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except('destroy');
// });

// Route::prefix('admin')->group(function () {
//     Route::redirect('/', '/admin/courses')->name('admin.dashboard');
//     Route::resource('courses', AdminCourseController::class)->names('admin.courses');
//     Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except('destroy');
// });

Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/orders')->name('admin.orders');
    Route::resource('courses', AdminCourseController::class)->names('admin.courses')->except('show');
    Route::resource('categories', AdminCategoryController::class)->names('admin.categories')->except(['show', 'destroy']);
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
});

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::view('/teams', 'teams')->name('teams');

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
    Route::post('/cart/buy/{course}', [CartController::class, 'buy'])->name('cart.buy');
    Route::delete('/cart/{course}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
    Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
    Route::get('/course/{id}/learn', [CourseController::class, 'startLearning'])->name('course.learn');
    Route::get('/profile/course', [CourseController::class, 'index'])->name('course.index');
});

// Route::post('/vnpay/ipn', [VNPayController::class, 'ipn'])->name('vnpay.ipn');
//GET ERROR WHEN PLACING THESE ROUTE
// Route::middleware(['auth'])->group(function () {
//     Route::post('/vnpay/create-payment', [VNPayController::class, 'createPayment'])->name('vnpay.create-payment');
//     Route::get('/vnpay/return', [VNPayController::class, 'return'])->name('vnpay.return');
// });

Route::get('/course/{course_id}', [CourseController::class, 'show'])->name('course.show');
require __DIR__ . '/auth.php';
Route::get('/courses/search', [CourseController::class, 'search'])->name('course.search');

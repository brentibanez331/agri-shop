<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RatingController;

Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

// Remove after done with testing
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Operations
Route::get('continue-profile', function () {
    return view('auth/continue-profile');
})->middleware(['auth', 'verified'])->name('continue-profile');

Route::get('/your-shop', [MerchantController::class, 'getUserShops'])->name('your-shop')->middleware(['auth', 'verified']);
Route::put('/update-profile', [UserController::class, 'update'])->name('update-profile')->middleware(['auth', 'verified']);
Route::get('/profile', [UserController::class, 'edit'])->name('profile')->middleware(['auth', 'verified']);
Route::put('/update-account', [UserController::class, 'account'])->name('update-account')->middleware(['auth', 'verified']);
Route::get('/delete-profile', [UserController::class, 'delete'])->name('delete-user')->middleware(['auth', 'verified']);
Route::get('/previous', function () {
    return redirect()->back();
})->name('previous');

// Product Operations
Route::get('/add-product/{merchant}', [ProductController::class, 'add'])->name('add-product')->middleware(['auth', 'verified']);
Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('store-product');
Route::get('/edit-product/{productId}/{merchantId}', [ProductController::class, 'edit'])->name('edit-product')->middleware(['auth', 'verified']);
Route::put('/update-product/{product}', [ProductController::class, 'update'])->name('update-product');
Route::get('/delete-product/{productId}/{merchantId}', [ProductController::class, 'delete'])->name('delete-product');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product');

// Shop Operations
Route::get('/manage-shop/{merchant}', [MerchantController::class, 'getProducts'])->name('manage-shop')->middleware(['auth', 'verified']);
Route::get('/manage-orders/{merchant}', [MerchantController::class, 'getOrders'])->name('manage-orders')->middleware(['auth', 'verified']);
Route::get('/add-shop', function () {
    return view('merchant.add');
})->middleware(['auth', 'verified'])->name('add-shop');
Route::get('/edit-shop/{merchant}', [MerchantController::class, 'edit'])->name('edit-shop')->middleware(['auth', 'verified']);
Route::post('/store-shop', [MerchantController::class, 'store'])->name('store-shop');
Route::put('/update-shop/{merchant}', [MerchantController::class, 'update'])->name('update-shop');
Route::get('/delete-shop/{merchant}', [MerchantController::class, 'delete'])->name('delete-shop');
Route::get('/view-shop/{merchant}', [MerchantController::class, 'show'])->name('view-shop');


// Cart Operations
Route::get('/cart', [CartController::class, 'show'])->name('manage-cart')->middleware(['auth', 'verified']);
Route::post('/store-cart/{product}', [CartController::class, 'handler'])->name('store-cart');
Route::post('/minus-cart/{itemId}/{cartId}', [CartController::class, 'minus'])->name('minus-cart');
Route::post('/plus-cart/{itemId}/{cartId}', [CartController::class, 'plus'])->name('plus-cart');
Route::get('/delete-cart/{item}', [CartController::class, 'delete'])->name('delete-cart');

// Transaction Operations
Route::get('/transact', [CartController::class, 'handler'])->name('transact')->middleware(['auth', 'verified']);
Route::get('/cart-transact/{item}', [TransactionController::class, 'transact'])->name('cart-transact')->middleware(['auth', 'verified']);
Route::post('/store-transact/{product}', [TransactionController::class, 'store'])->name('store-transact')->middleware(['auth', 'verified']);
Route::get('/transact/all', [TransactionController::class, 'show'])->name('show-transact')->middleware(['auth', 'verified']);
Route::get('/confirm-order/{trans}', [TransactionController::class, 'confirm'])->name('confirm-order');
Route::get('/cancel-order/{trans}', [TransactionController::class, 'cancel'])->name('cancel-order');
Route::get('/delete-trans/{trans}', [TransactionController::class, 'delete'])->name('delete-trans');

// Rating Operations
Route::get('/rate/{trans}', [RatingController::class, 'index'])->name('rate');
Route::post('/store-review/{product}', [RatingController::class, 'store'])->name('store-review')->middleware(['auth', 'verified']);
Route::get('/edit-review/{product}', [RatingController::class, 'edit'])->name('edit-review')->middleware(['auth', 'verified']);
Route::put('/update-review/{rating}', [RatingController::class, 'update'])->name('update-review');
Route::get('/delete-review/{rating}', [RatingController::class, 'delete'])->name('delete-review');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

// Route::get('/userdelete/{id}', [UserController::class, 'delete'])->name('admin.deleteuser');


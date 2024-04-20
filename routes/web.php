<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MerchantController;

Route::get('/', [LandingPageController::class, 'index'])->name('welcome');

// Remove after done with testing
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('continue-profile', function () {
    return view('auth/continue-profile');
})->middleware(['auth', 'verified'])->name('continue-profile');

Route::get('/your-shop', [MerchantController::class, 'getUserShops'])->name('your-shop')->middleware(['auth', 'verified']);
Route::post('update-profile', [UserController::class, 'update'])->name('update-profile')->middleware(['auth', 'verified']);
Route::get('/previous', function () {
    return redirect()->back();
})->name('previous');

// Product Operations
Route::get('/add-product/{merchant}', [ProductController::class, 'addProduct'])->name('add-product')->middleware(['auth', 'verified']);
Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('store-product');

// Shop Operations
Route::get('/manage-shop/{merchant}', [MerchantController::class, 'getProducts'])->name('manage-shop')->middleware(['auth', 'verified']);
Route::get('/add-shop', function () {
    return view('merchant.add');
})->middleware(['auth', 'verified'])->name('add-shop');
Route::get('/edit-shop/{merchant}', [MerchantController::class, 'edit'])->name('edit-shop')->middleware(['auth', 'verified']);
Route::post('/store-shop', [MerchantController::class, 'store'])->name('store-shop');
Route::put('/update-shop', [MerchantController::class, 'update'])->name('update-shop');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product');
// Route::get('/userdelete/{id}', [UserController::class, 'delete'])->name('admin.deleteuser');


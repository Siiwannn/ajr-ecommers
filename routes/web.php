<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Product;

// Frontend Routes
Route::get('/', function () {
    return view('frontend.beranda');  // ← Ubah jadi beranda
})->name('home');

Route::get('/product', function () {
    return view('frontend.product');  // ← Halaman product terpisah
})->name('product');


Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('frontend.product-detail', compact('product'));
})->name('product.detail');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');
});
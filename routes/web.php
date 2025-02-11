<?php
use App\Http\Controllers\SaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MessageController;

Route::get('/', [SaleController::class, 'index'])->name('home');
Route::resource('sales', SaleController::class);
Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::get('/messages/{sale}/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{sale}/{user}', [MessageController::class, 'store'])->name('messages.store');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
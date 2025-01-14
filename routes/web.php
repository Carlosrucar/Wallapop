<?php
use App\Http\Controllers\SaleController;

Route::get('/', [SaleController::class, 'index'])->name('home');
Route::resource('sales', SaleController::class);
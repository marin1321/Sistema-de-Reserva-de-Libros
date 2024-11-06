<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->middleware('auth')->name('reservations.destroy');
Route::get('/books', [BookController::class, 'index'])->middleware('auth')->name('books.index');
Route::get('/books/{book}/reserve', [BookController::class, 'reserve'])->middleware('auth')->name('books.reserve');
Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

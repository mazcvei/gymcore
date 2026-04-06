<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/mi_ruta/{mario}',[PruebaController::class, 'welcome'] );

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   // Route::middleware('admin')->group(function () {
        Route::get('/admin1', [AdminController::class, 'index1'])->name('admin1.index');
        Route::get('/admin2', [AdminController::class, 'index2'])->name('admin2.index');
  //  });
});

require __DIR__.'/auth.php';

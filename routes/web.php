<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/clases', [GymClassController::class, 'index'])->name('classes.index');
Route::get('/clases/{gymClass}', [GymClassController::class, 'show'])->name('classes.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/plan/{membershipplan}', [PaymentController::class, 'create'])->name('payments.create');

    Route::post('/pago/{membershipplan}', [PaymentController::class, 'store'])->name('payments.store');

    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        Route::get('/listar-clases', [AdminController::class, 'indexClasses'])->name('admin.classes.index');
        Route::get('/nueva-clase', [GymClassController::class, 'create'])->name('admin.classes.create');
        Route::post('/guardar-clase', [GymClassController::class, 'store'])->name('admin.classes.store');
        Route::put('/actualizar-clase/{gymClass}', [GymClassController::class, 'update'])->name('admin.classes.update');
        Route::get('/editar-clase/{gymClass}', [GymClassController::class, 'edit'])->name('admin.classes.edit');
        Route::get('/horarios.clase', [ScheduleController::class, 'create'])->name('admin.schedules.create');
        Route::delete('/eliminar-clase/{gymClass}', [GymClassController::class, 'destroy'])->name('admin.classes.destroy');

        Route::get('entrenadores', [AdminController::class, 'indexTrainers'])->name('admin.trainers.index');
        Route::get('nuevo-entrenador', [AdminController::class, 'createTrainer'])->name('admin.trainers.create');
        Route::get('editar-entrenador/{trainer}', [AdminController::class, 'editTrainer'])->name('admin.trainers.edit');
        Route::put('editar-entrenador/{trainer}', [AdminController::class, 'updateTrainer'])->name('admin.trainers.update');
        Route::post('crear-entrenador', [AdminController::class, 'storeTrainer'])->name('admin.trainers.store');
        Route::delete('entrenadores/{trainer}', [AdminController::class, 'destroyTrainer'])->name('admin.trainers.destroy');

        Route::get('membresias', [AdminController::class, 'indexMemberships'])->name('admin.memberships.index');
    });
});

require __DIR__ . '/auth.php';

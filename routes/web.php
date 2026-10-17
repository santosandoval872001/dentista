<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Crear cita
Route::get('/cita', [CitaController::class, 'crear'])
    ->name('cita.crear');

// Guardar cita
Route::post('/cita', [CitaController::class, 'guardar'])
    ->name('cita.guardar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('dentista')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pagina index
    Route::get('/admin/citas', [CitaController::class, 'index'])
        ->name('admin.citas');

    // Estado de la cita
    Route::patch('/admin/citas/{cita}/confirmar', [CitaController::class, 'confirmar'])
        ->name('admin.citas.confirmar');

    // Enlace WhatsApp
    Route::get('/admin/citas/{cita}/whatsapp', [CitaController::class, 'whatsapp'])
        ->name('admin.citas.whatsapp');

    // Cancelar la cita
    Route::patch('/admin/citas/{cita}/cancelar', [CitaController::class, 'cancelar'])
        ->name('admin.citas.cancelar');

    // Atender cita
    Route::patch('/admin/citas/{cita}/atender', [CitaController::class, 'atender'])
        ->name('admin.citas.atender');

    /* Calendario de citas  */
    Route::get('/admin/calendario', function () {
        return view('citas.calendario');
    })->name('admin.calendario');

    /* Obtener las rutas de las citas */
    Route::get('/admin/calendario/eventos', [CitaController::class, 'eventos'])
        ->name('admin.calendario.eventos');
});

require __DIR__ . '/auth.php';

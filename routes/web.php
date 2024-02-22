<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\NotificacionController;

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
})->name('home');

Route::get('/dashboard', [VacanteController::class,'index'])->middleware(['auth','verified'])->name('vacantes.index');
Route::get('/vacantes/create', [VacanteController::class,'create'])->middleware(['auth','verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class,'edit'])->middleware(['auth','verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class,'show'])->middleware(['auth','verified'])->name('vacantes.show');

//notificaciones
Route::get('/notificaciones',NotificacionController::class)->middleware(['auth','verified','rol.reclutador'])->name('notificaciones');

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestigadorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ExperimentoController;
use App\Http\Controllers\NotaInvestigacionController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('about', [DashboardController::class, 'about'])->name('about');
Route::get('sql', [DashboardController::class, 'sql'])->name('sql');
Route::get('inyection', [DashboardController::class, 'inyection'])->name('inyection');



Route::get('imagen/{id}', [App\Http\Controllers\ImagenController::class, 'imagen'])->name('imagen');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [App\Http\Controllers\HomeController::class, 'update'])->name('profile.update');


Route::middleware(['auth'])->group(function () {
    Route::resource('investigadores', InvestigadorController::class)->parameters([
        'investigadores' => 'investigador'
    ]);
    Route::resource('proyectos', ProyectoController::class);
    Route::put('equipos/{equipo}/asignar', [EquipoController::class, 'asignar'])->name('equipos.asignar');
    Route::put('equipos/{equipo}/liberar', [EquipoController::class, 'liberar'])->name('equipos.liberar');
    Route::resource('equipos', EquipoController::class);
    Route::resource('experimentos', ExperimentoController::class);
    Route::resource('notas', NotaInvestigacionController::class);
});

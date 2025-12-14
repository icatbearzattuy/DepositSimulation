<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Simulation Routes
    Route::get('/simulation', [SimulationController::class, 'index'])->name('simulation.index');
    Route::post('/simulation/calculate', [SimulationController::class, 'calculate'])->name('simulation.calculate');

    // Compare Routes (SEMUA bank)
    Route::get('/simulation/compare', [SimulationController::class, 'compareIndex'])->name('simulation.compare');
    Route::post('/simulation/compare', [SimulationController::class, 'compare'])->name('simulation.compare');


    Route::post('/simulation/store', [SimulationController::class, 'store'])->name('simulation.store');
    Route::get('/simulation/history', [SimulationController::class, 'history'])->name('simulation.history');
});

require __DIR__ . '/auth.php';

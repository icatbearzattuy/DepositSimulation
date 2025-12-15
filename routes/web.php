<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBankController;
use App\Http\Controllers\Admin\AdminSimulationController;
use App\Http\Controllers\CetakpdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    $stats = [
        'total_simulations' => \App\Models\Simulation::where('user_id', $user->user_id)->count(),
        'total_bunga' => \App\Models\Simulation::where('user_id', $user->user_id)->sum('bunga_diterima'),
        'total_deposito' => \App\Models\Simulation::where('user_id', $user->user_id)->sum('nominal_deposito'),
    ];
    $recent_simulations = \App\Models\Simulation::with('bank')
        ->where('user_id', $user->user_id)
        ->orderBy('waktu_simulasi', 'desc')
        ->limit(5)
        ->get();
    return view('dashboard', compact('stats', 'recent_simulations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Simulation Routes
    Route::get('/simulation', [SimulationController::class, 'index'])->name('simulation.index');
    Route::post('/simulation', [SimulationController::class, 'calculate'])->name('simulation.index');

    // Compare Routes (SEMUA bank)
    Route::get('/simulation/compare', [SimulationController::class, 'compareIndex'])->name('simulation.compare');
    Route::post('/simulation/compare', [SimulationController::class, 'compare'])->name('simulation.compare');


    Route::post('/simulation/store', [SimulationController::class, 'store'])->name('simulation.store');
    Route::get('/simulation/history', [SimulationController::class, 'history'])->name('simulation.history');

    Route::post('/simulation/pdf', [CetakpdfController::class, 'cetakPdf'])
        ->name('simulation.pdf');
    Route::get('/simulation/history-pdf', [CetakpdfController::class, 'historyPdf'])
        ->name('simulation.history-pdf');
});

// ==================== ADMIN ROUTES ====================

// Admin Auth (tanpa middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('banks', AdminBankController::class);
    Route::get('/simulations', [AdminSimulationController::class, 'index'])->name('simulations.index');
});

require __DIR__ . '/auth.php';

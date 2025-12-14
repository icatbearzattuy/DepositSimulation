<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Simulation;
use App\Models\User;

class AdminDashboardController extends Controller
{
  public function index()
  {
    $stats = [
      'total_banks' => Bank::count(),
      'total_simulations' => Simulation::count(),
      'total_users' => User::count(),
    ];

    $recent_simulations = Simulation::with(['user', 'bank'])
      ->orderBy('waktu_simulasi', 'desc')
      ->limit(5)
      ->get();

    return view('admin.dashboard', compact('stats', 'recent_simulations'));
  }
}

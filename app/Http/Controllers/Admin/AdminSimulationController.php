<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use Illuminate\Http\Request;

class AdminSimulationController extends Controller
{
  public function index(Request $request)
  {
    $query = Simulation::with(['user', 'bank']);

    // Filter by bank
    if ($request->filled('bank_id')) {
      $query->where('bank_id', $request->bank_id);
    }

    // Filter by date range
    if ($request->filled('date_from')) {
      $query->whereDate('waktu_simulasi', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
      $query->whereDate('waktu_simulasi', '<=', $request->date_to);
    }

    $simulations = $query->orderBy('waktu_simulasi', 'desc')->paginate(15);
    $banks = \App\Models\Bank::all();

    return view('admin.simulations.index', compact('simulations', 'banks'));
  }

  public function show($id)
  {
    $simulation = Simulation::with(['user', 'bank'])
      ->where('simulasi_id', $id)
      ->firstOrFail();

    return view('admin.simulations.show', compact('simulation'));
  }
}

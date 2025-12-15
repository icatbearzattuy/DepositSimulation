<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Simulation;

class CetakpdfController extends Controller
{
  public function cetakPdf(Request $request)
  {
    $bank = Bank::findOrFail($request->bank_id);

    $nominal = $request->nominal_deposito;
    $jangka_waktu = $request->jangka_waktu_bulan;

    $bunga_diterima = $nominal
      * ($bank->suku_bunga_dasar / 100)
      * ($jangka_waktu / 12);

    $pdf = Pdf::loadView('simulation.pdf', [
      'bank' => $bank,
      'nominal' => $nominal,
      'jangka_waktu' => $jangka_waktu,
      'bunga_diterima' => $bunga_diterima,
      'total_akhir' => $nominal + $bunga_diterima,
    ]);

    return $pdf->download('simulasi-deposito.pdf');
  }

  public function historyPdf()
  {
    $simulations = Simulation::with('bank')
      ->where('user_id', Auth::id())
      ->orderBy('waktu_simulasi', 'desc')
      ->get();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('simulation.history-pdf', [
      'simulations' => $simulations,
    ]);

    return $pdf->download('history-simulasi.pdf');
    // atau ->stream()
  }
}

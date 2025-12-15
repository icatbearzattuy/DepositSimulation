<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use Barryvdh\DomPDF\Facade\Pdf;

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
}

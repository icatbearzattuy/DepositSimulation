<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Simulation;
use Illuminate\Support\Facades\DB;

class SimulationController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('simulation.index', compact('banks'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        $nominal = $request->nominal_deposito;
        $jangka_waktu = $request->jangka_waktu_bulan;

        $banks = Bank::all();
        $results = [];

        foreach ($banks as $bank) {
            $bunga_diterima = $nominal * ($bank->suku_bunga_dasar / 100) * $jangka_waktu;
            $total_akhir = $nominal + $bunga_diterima;
            $results[] = [
                'bank_id' => $bank->bank_id,
                'nama_bank' => $bank->nama_bank,
                'suku_bunga_dasar' => $bank->suku_bunga_dasar,
                'bunga_diterima' => $bunga_diterima,
                'total_akhir' => $total_akhir,
            ];
        }
        return view('simulation.result', [
            'results' => $results,
            'nominal' => $nominal,
            'jangka_waktu' => $jangka_waktu,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bank_id' => 'required',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);
        DB::statement('call sp_simuldep(?, ?, ?, ?)', [
            $request->user_id,
            $request->bank_id,
            $request->nominal_deposito,
            $request->jangka_waktu_bulan,
        ]);
        return redirect()->route('simulation.index')->with('success', 'Simulation berhasil disimpan');
    }

    public function history()
    {
        $simulations = Simulation::all();
        return view('simulation.history', compact('simulations'));
    }
}

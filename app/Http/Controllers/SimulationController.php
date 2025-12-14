<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Simulation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimulationController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('simulation.index', [
            'banks' => $banks,
            'results' => null,
            'nominal' => null,
            'jangka_waktu' => null
        ]);
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        $nominal = $request->nominal_deposito;
        $jangka_waktu = $request->jangka_waktu_bulan;

        $bank = Bank::findOrFail($request->bank_id);

        $bunga_diterima = $nominal
            * ($bank->suku_bunga_dasar / 100)
            * ($jangka_waktu / 12);

        $results[] = [
            'bank_id' => $bank->bank_id,
            'nama_bank' => $bank->nama_bank,
            'suku_bunga_dasar' => $bank->suku_bunga_dasar,
            'bunga_diterima' => $bunga_diterima,
            'total_akhir' => $nominal + $bunga_diterima,
        ];

        return view('simulation.index', [
            'banks' => Bank::all(),
            'results' => $results,
            'nominal' => $nominal,
            'jangka_waktu' => $jangka_waktu
        ]);
    }

    public function compare(Request $request)
    {
        $request->validate([
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        $nominal = $request->nominal_deposito;
        $jangka_waktu = $request->jangka_waktu_bulan;

        $bank = Bank::all();

        foreach ($bank as $bank) {
            $bunga_diterima = $nominal
                * ($bank->suku_bunga_dasar / 100)
                * ($jangka_waktu / 12);

            $results[] = [
                'bank_id' => $bank->bank_id,
                'nama_bank' => $bank->nama_bank,
                'suku_bunga_dasar' => $bank->suku_bunga_dasar,
                'bunga_diterima' => $bunga_diterima,
                'total_akhir' => $nominal + $bunga_diterima,
            ];
        }

        return view('simulation.index', [
            'banks' => Bank::all(),
            'results' => $results,
            'nominal' => $nominal,
            'jangka_waktu' => $jangka_waktu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        try {
            DB::statement('CALL sp_simuldep(?, ?, ?, ?)', [
                Auth::id(),
                $request->bank_id,
                $request->nominal_deposito,
                $request->jangka_waktu_bulan,
            ]);

            return back()->with('success', 'Simulasi berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
    public function history()
    {
        $simulations = Simulation::all();
        return view('simulation.history', compact('simulations'));
    }
}

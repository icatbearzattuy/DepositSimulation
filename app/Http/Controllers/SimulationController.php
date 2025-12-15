<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Simulation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimulationController extends Controller
{
    public function index()
    {
        $banks = Bank::all();

        $results = session('simulation_results');
        $nominal = session('simulation_nominal');
        $jangka_waktu = session('simulation_jangka_waktu');

        // clear session
        session()->forget(['simulation_results', 'simulation_nominal', 'simulation_jangka_waktu']);

        return view('simulation.index', [
            'banks' => $banks,
            'results' => $results,
            'nominal' => $nominal,
            'jangka_waktu' => $jangka_waktu
        ]);
    }

    // Untuk hitung 1 bank saja
    public function calculate(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        $nominal = $request->nominal_deposito;
        $jangka_waktu = $request->jangka_waktu_bulan;
        $bank = Bank::findOrFail($request->bank_id);

        $bunga_diterima = $nominal * ($bank->suku_bunga_dasar / 100) * ($jangka_waktu / 12);

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

    // Halaman compare SEMUA bank (GET)
    public function compareIndex()
    {
        $banks = Bank::all();

        // Ambil hasil dari session jika ada
        $results = session('compare_results');
        $nominal = session('compare_nominal');
        $jangka_waktu = session('compare_jangka_waktu');

        // Clear session setelah diambil
        session()->forget(['compare_results', 'compare_nominal', 'compare_jangka_waktu']);

        return view('simulation.compare', [
            'banks' => $banks,
            'results' => $results,
            'nominal' => $nominal,
            'jangka_waktu' => $jangka_waktu
        ]);
    }

    //post
    public function compare(Request $request)
    {
        $request->validate([
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|numeric|min:1|max:120',
        ]);

        $nominal = $request->nominal_deposito;
        $jangka_waktu = $request->jangka_waktu_bulan;
        $banks = Bank::all();
        $results = [];

        foreach ($banks as $bank) {
            $bunga_diterima = $nominal * ($bank->suku_bunga_dasar / 100) * ($jangka_waktu / 12);

            $results[] = [
                'bank_id' => $bank->bank_id,
                'nama_bank' => $bank->nama_bank,
                'suku_bunga_dasar' => $bank->suku_bunga_dasar,
                'bunga_diterima' => $bunga_diterima,
                'total_akhir' => $nominal + $bunga_diterima,
            ];
        }

        // Sort by total_akhir descending (bank terbaik di atas)
        usort($results, function ($a, $b) {
            return $b['total_akhir'] <=> $a['total_akhir'];
        });

        // Simpan ke session
        session([
            'compare_results' => $results,
            'compare_nominal' => $nominal,
            'compare_jangka_waktu' => $jangka_waktu
        ]);

        // Redirect ke halaman compare (GET) - biar bisa di-refresh
        return redirect()->route('simulation.compare');
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
        $simulations = Simulation::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('simulation.history', compact('simulations'));
    }
}

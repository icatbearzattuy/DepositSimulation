<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class AdminBankController extends Controller
{
  public function index()
  {
    $banks = Bank::orderBy('bank_id', 'asc')->get();
    return view('admin.banks.index', compact('banks'));
  }

  public function create()
  {
    return view('admin.banks.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_bank' => 'required|string|max:50',
      'suku_bunga_dasar' => 'required|numeric|min:0|max:100',
    ]);

    Bank::create([
      'nama_bank' => $request->nama_bank,
      'suku_bunga_dasar' => $request->suku_bunga_dasar,
    ]);

    return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil ditambahkan!');
  }

  public function edit($id)
  {
    $bank = Bank::where('bank_id', $id)->firstOrFail();
    return view('admin.banks.edit', compact('bank'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama_bank' => 'required|string|max:50',
      'suku_bunga_dasar' => 'required|numeric|min:0|max:100',
    ]);

    $bank = Bank::where('bank_id', $id)->firstOrFail();
    $bank->update([
      'nama_bank' => $request->nama_bank,
      'suku_bunga_dasar' => $request->suku_bunga_dasar,
    ]);

    return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil diupdate!');
  }

  public function destroy($id)
  {
    $bank = Bank::where('bank_id', $id)->firstOrFail();
    $bank->delete();

    return redirect()->route('admin.banks.index')->with('success', 'Bank berhasil dihapus!');
  }
}

@extends('layouts.admin')

@section('title', 'Semua Simulasi')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <!-- Header with Filters -->
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Daftar Semua Simulasi</h3>
            
            <!-- Filter Form -->
            <form action="{{ route('admin.simulations.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bank</label>
                    <select name="bank_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Bank</option>
                        @foreach($banks as $bank)
                            <option value="{{ $bank->bank_id }}" {{ request('bank_id') == $bank->bank_id ? 'selected' : '' }}>
                                {{ $bank->nama_bank }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.simulations.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jangka Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bunga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Akhir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($simulations as $sim)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $sim->simulasi_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $sim->user->nama_lengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $sim->bank->nama_bank ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($sim->nominal_deposito, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $sim->jangka_waktu_bulan }} Bulan</td>
                            <td class="px-6 py-4 text-sm text-blue-600 font-medium">Rp {{ number_format($sim->bunga_diterima, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp {{ number_format($sim->total_akhir, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $sim->waktu_simulasi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">Belum ada data simulasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($simulations->hasPages())
            <div class="p-6 border-t border-gray-100">
                {{ $simulations->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection

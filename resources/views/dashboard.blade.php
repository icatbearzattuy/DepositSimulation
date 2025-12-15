<x-app-layout>
<div class="py-16">
    <div class="max-w-7xl mx-auto sm:px-6">       
    <nav class="flex mb-2.5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
                    <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/></svg>
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center space-x-1.5">
                    <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                    <span class="inline-flex items-center text-sm font-medium text-body-subtle">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
    <h2 class="text-3xl font-bold tracking-tight text-heading md:text-4xl">Welcome, <span class="text-[#129661]">{{ Auth::user()->nama_lengkap }}</span>!</h2>
    </div>

    <!-- Stats Cards -->
    <div class="max-w-7xl mx-auto sm:px-6 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Simulasi -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Simulasi</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_simulations'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="max-w-7xl mx-auto sm:px-6 mt-8">
        <div class="flex gap-4">
            <a href="{{ route('simulation.index') }}" class="inline-flex items-center gap-2 bg-[#129661] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#0d7a4d] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Simulation
            </a>
            <a href="{{ route('simulation.compare') }}" class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Compare Banks
            </a>
        </div>
    </div>

    <!-- Recent Simulations -->
    <div class="max-w-7xl mx-auto sm:px-6 mt-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Simulasi Terbaru</h3>
                <a href="{{ route('simulation.history') }}" class="text-sm text-[#129661] hover:underline">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tenor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bunga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recent_simulations as $sim)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $sim->bank->nama_bank ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($sim->nominal_deposito, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $sim->jangka_waktu_bulan }} Bulan</td>
                                <td class="px-6 py-4 text-sm font-medium text-blue-600">Rp {{ number_format($sim->bunga_diterima, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp {{ number_format($sim->total_akhir, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $sim->waktu_simulasi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada simulasi. <a href="{{ route('simulation.index') }}" class="text-[#129661] hover:underline">Buat simulasi pertama!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
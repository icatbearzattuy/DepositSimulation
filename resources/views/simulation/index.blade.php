<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">       
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-500">Simulasi Deposito</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Content -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Deposit Simulation</h2>
                    <p class="mt-2 text-sm text-gray-600">Compare deposit yields from various banks to get the best returns</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Form Section -->
                    <div>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">Masukkan Data Simulasi</h3>
                            
                            <form action="{{ route('simulation.index') }}" method="POST" class="space-y-6">
                                @csrf
                                
                                <!-- Dropdown Bank -->
                                <div x-data="{ open: false, selected: 'Pilih Bank', bankId: '' }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Bank <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <button type="button"
                                            @click="open = !open"
                                            class="w-full flex justify-between items-center px-4 py-3 text-left
                                                border border-gray-300 rounded-lg bg-white hover:bg-gray-50
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                                transition duration-150"
                                        >
                                            <span x-text="selected" class="text-sm text-gray-700"></span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" 
                                                :class="{ 'rotate-180': open }" 
                                                xmlns="http://www.w3.org/2000/svg" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div x-show="open" 
                                            @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute z-20 mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg"
                                        >
                                            @foreach ($banks as $bank)
                                                <button type="button"
                                                    @click="
                                                        selected = '{{ $bank->nama_bank }}';
                                                        bankId = '{{ $bank->bank_id }}';
                                                        open = false;
                                                    "
                                                    class="block w-full text-left px-4 py-3 hover:bg-blue-50 text-sm text-gray-700
                                                        first:rounded-t-lg last:rounded-b-lg transition duration-150"
                                                >
                                                    <div class="flex justify-between items-center">
                                                        <span class="font-medium">{{ $bank->nama_bank }}</span>
                                                        <span class="text-xs text-blue-600 font-semibold">{{ $bank->suku_bunga_dasar }}%</span>
                                                    </div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="bank_id" :value="bankId" required>
                                </div>

                                <!-- Input Nominal -->
                                <div>
                                    <label for="nominal_deposito" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nominal Deposito <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm font-medium">Rp</span>
                                    <input 
                                            type="text"
                                            id="nominal_display"
                                            placeholder="10.000.000"
                                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg
                                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                                text-sm text-gray-900 placeholder-gray-400"
                                            oninput="formatRupiah(this)"
                                            autocomplete="off"
                                            min="1000000"
                                            required
                                        >
                                        <input 
                                            type="hidden" 
                                            name="nominal_deposito" 
                                            id="nominal_real"
                                        >
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Minimal Rp 1.000.000</p>
                                </div>

                                <!-- Dropdown Jangka Waktu -->
                                <div x-data="{ open: false, selected: 'Pilih Jangka Waktu', bulan: '' }">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Jangka Waktu <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <button type="button"
                                            @click="open = !open"
                                            class="w-full flex justify-between items-center px-4 py-3 text-left
                                                border border-gray-300 rounded-lg bg-white hover:bg-gray-50
                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                                transition duration-150"
                                        >
                                            <span x-text="selected" class="text-sm text-gray-700"></span>
                                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" 
                                                :class="{ 'rotate-180': open }" 
                                                xmlns="http://www.w3.org/2000/svg" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div x-show="open" 
                                            @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute z-20 mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto"
                                        >
                                            @foreach ([3, 6, 9, 12, 18, 24, 36, 48, 60] as $month)
                                                <button type="button"
                                                    @click="
                                                        selected = '{{ $month }} Bulan';
                                                        bulan = '{{ $month }}';
                                                        open = false;
                                                    "
                                                    class="block w-full text-left px-4 py-3 hover:bg-blue-50 text-sm text-gray-700
                                                        first:rounded-t-lg last:rounded-b-lg transition duration-150"
                                                >
                                                    {{ $month }} Bulan ({{ number_format($month / 12, 1) }} Tahun)
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="jangka_waktu_bulan" :value="bulan" required>
                                </div>

                                <!-- Submit Button -->
                                <button 
                                    type="submit" 
                                    class="w-full inline-flex justify-center items-center gap-2 
                                        px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg
                                        hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                        transition duration-150 shadow-sm"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Hitung Simulasi
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Result Section (Kanan) -->
                    <div>
                        @if (!empty($results))
                            <div class="bg-green-50 rounded-lg p-6 border border-green-200">
                                <div class="flex items-center gap-2 mb-6">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Hasil Perbandingan</h3>
                                </div>

                                <div class="mb-4 p-4 bg-white rounded-lg border border-green-100">
                                    <p class="text-sm text-gray-600">Nominal Deposito</p>
                                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($nominal, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600 mt-2">Jangka Waktu: <span class="font-semibold">{{ $jangka_waktu }} Bulan</span></p>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($results as $result)
                                        <div class="bg-white p-5 rounded-lg border-2 border-blue-100 hover:border-blue-300 transition duration-150">
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <h4 class="text-lg font-bold text-gray-900">{{ $result['nama_bank'] }}</h4>
                                                    <p class="text-sm text-gray-500">Suku Bunga: {{ $result['suku_bunga_dasar'] }}%</p>
                                                </div>
                                            </div>
                                            <div class="space-y-2 pt-3 border-t border-gray-100">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-600">Bunga Diterima</span>
                                                    <span class="text-lg font-semibold text-green-600">Rp {{ number_format($result['bunga_diterima'], 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                                    <span class="text-sm font-semibold text-gray-700">Total Akhir</span>
                                                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($result['total_akhir'], 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <form action="{{ route('simulation.pdf') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bank_id" value="{{ $result['bank_id'] }}">
                                    <input type="hidden" name="nominal_deposito" value="{{ $nominal }}">
                                    <input type="hidden" name="jangka_waktu_bulan" value="{{ $jangka_waktu }}">

                                    <button type="submit"
                                        class="mt-4 px-4 py-2 bg-red-600 text-white rounded">
                                        Cetak PDF
                                    </button>
                                </form>
                        <!-- Form Simpan Per Bank -->
                        <form action="{{ route('simulation.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="bank_id" value="{{ $result['bank_id'] }}">
                            <input type="hidden" name="nominal_deposito" value="{{ $nominal }}">
                            <input type="hidden" name="jangka_waktu_bulan" value="{{ $jangka_waktu }}">
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-150 text-sm flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Simpan {{ $result['nama_bank'] }}
                            </button>
                        </form>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300 h-full flex flex-col items-center justify-center text-center">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-500 mb-2">Belum Ada Hasil</h3>
                                <p class="text-sm text-gray-400">Isi form di sebelah kiri untuk melihat hasil perbandingan deposito</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function formatRupiah(el) {
    // ambil angka saja
    let value = el.value.replace(/\D/g, '');

    // simpan angka asli ke hidden input
    document.getElementById('nominal_real').value = value;

    // format ke rupiah
    el.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

</x-app-layout>
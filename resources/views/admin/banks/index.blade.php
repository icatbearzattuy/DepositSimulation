@extends('layouts.admin')

@section('title', 'Kelola Bank')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <!-- Header -->
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Bank</h3>
            <a href="{{ route('admin.banks.create') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Bank
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Bank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Suku Bunga</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($banks as $bank)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $bank->bank_id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $bank->nama_bank }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    {{ $bank->suku_bunga_dasar }}%
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.banks.edit', $bank->bank_id) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg text-sm font-medium hover:bg-yellow-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.banks.destroy', $bank->bank_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus bank ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data bank</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

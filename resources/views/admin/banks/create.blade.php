@extends('layouts.admin')

@section('title', 'Add Bank')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Add New Bank</h3>
            </div>

            <form action="{{ route('admin.banks.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="nama_bank" class="block text-sm font-medium text-gray-700 mb-2">
                        Bank Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_bank" 
                        id="nama_bank"
                        value="{{ old('nama_bank') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nama_bank') border-red-500 @enderror"
                        placeholder="Example: Bank BCA"
                        required
                    >
                    @error('nama_bank')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="suku_bunga_dasar" class="block text-sm font-medium text-gray-700 mb-2">
                        Base Interest Rate (%) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        name="suku_bunga_dasar" 
                        id="suku_bunga_dasar"
                        value="{{ old('suku_bunga_dasar') }}"
                        step="0.01"
                        min="0"
                        max="100"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('suku_bunga_dasar') border-red-500 @enderror"
                        placeholder="Example: 5.25"
                        required
                    >
                    @error('suku_bunga_dasar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save
                    </button>
                    <a href="{{ route('admin.banks.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

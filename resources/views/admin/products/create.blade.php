@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-gray-500 hover:text-primary mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
        <h1 class="font-display text-2xl font-bold text-primary">Tambah Produk Baru</h1>
    </div>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        
        <div class="luxury-card p-6 space-y-6">
            <div>
                <label class="form-label">Nama Produk <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="form-input" required maxlength="100">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" 
                       class="form-input" required min="0" step="100">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="form-label">Stok <span class="text-red-500">*</span></label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" 
                       class="form-input" required min="0">
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="form-label">Deskripsi</label>
                <textarea name="description" rows="4" class="form-input" maxlength="1000">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="form-label">Gambar Produk</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" 
                       class="form-input">
                <p class="text-xs text-gray-400 mt-1">Format: JPEG, PNG, WebP. Maksimal 2MB</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" 
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-5 h-5 text-secondary rounded border-gray-300 focus:ring-secondary">
                <label for="is_active" class="text-gray-700">Produk Aktif</label>
            </div>
            
            <div class="pt-4 border-t border-gray-200">
                <button type="submit" class="btn-primary w-full">
                    Simpan Produk
                </button>
            </div>
        </div>
    </form>
@endsection

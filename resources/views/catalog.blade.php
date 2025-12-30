@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="section-title">Katalog Produk</h1>
                <p class="section-subtitle">Temukan produk berkualitas untuk kebutuhan Anda</p>
            </div>
            
            <!-- Filters -->
            <div class="luxury-card-glass p-6 mb-8">
                <form action="{{ route('catalog') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari produk..." 
                               class="form-input">
                    </div>
                    <div class="w-full md:w-48">
                        <select name="sort" onchange="this.form.submit()" class="form-input">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama: A-Z</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                </form>
            </div>
            
            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="product-card">
                            <a href="{{ route('product.show', $product) }}">
                                <div class="relative overflow-hidden">
                                    @if($product->image_path)
                                        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="product-image">
                                    @else
                                        <div class="w-full aspect-square bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="product-overlay"></div>
                                    
                                    @if(!$product->inStock())
                                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                            Habis
                                        </div>
                                    @elseif($product->stock <= 5)
                                        <div class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                            Stok Terbatas
                                        </div>
                                    @endif
                                </div>
                            </a>
                            
                            <div class="p-5">
                                <a href="{{ route('product.show', $product) }}">
                                    <h3 class="font-display text-lg font-semibold text-primary mb-2 line-clamp-2 hover:text-secondary transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                <p class="text-secondary font-bold text-xl mb-4">{{ $product->formatted_price }}</p>
                                
                                @if($product->inStock())
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full btn-primary text-sm py-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg cursor-not-allowed text-sm">
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-display text-gray-500">Produk tidak ditemukan</h3>
                    <p class="text-gray-400 mt-2">Coba ubah kata kunci pencarian Anda</p>
                    <a href="{{ route('catalog') }}" class="btn-outline mt-6">Lihat Semua Produk</a>
                </div>
            @endif
        </div>
    </div>
@endsection

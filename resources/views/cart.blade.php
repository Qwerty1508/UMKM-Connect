@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="section-title mb-8">Keranjang Belanja</h1>
            
            @if(count($items) > 0)
                <div class="space-y-6">
                    @foreach($items as $item)
                        <div class="luxury-card p-6">
                            <div class="flex items-center gap-6">
                                <!-- Product Image -->
                                <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden">
                                    @if($item['product']->image_path)
                                        <img src="{{ $item['product']->image_path }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-display font-semibold text-primary text-lg">{{ $item['product']->name }}</h3>
                                    <p class="text-secondary font-bold">{{ $item['product']->formatted_price }}</p>
                                </div>
                                
                                <!-- Quantity Controls -->
                                <div class="flex items-center gap-4">
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center border border-gray-200 rounded-lg">
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" 
                                                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 {{ $item['quantity'] <= 1 ? 'opacity-50' : '' }}">-</button>
                                            <span class="px-4 py-1 text-center min-w-[3rem]">{{ $item['quantity'] }}</span>
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" 
                                                    class="px-3 py-1 text-gray-600 hover:bg-gray-100 {{ $item['quantity'] >= $item['product']->stock ? 'opacity-50' : '' }}">+</button>
                                        </div>
                                    </form>
                                    
                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Subtotal -->
                                <div class="text-right min-w-[100px]">
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="font-bold text-primary">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Cart Summary -->
                <div class="luxury-card p-6 mt-8">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg text-gray-600">Total</span>
                        <span class="text-2xl font-bold text-secondary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('cart.clear') }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full btn-ghost border border-gray-200">
                                Kosongkan Keranjang
                            </button>
                        </form>
                        
                        @auth
                            <a href="{{ route('checkout') }}" class="flex-1 btn-primary text-center">
                                Lanjut ke Checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}?redirect=checkout" class="flex-1 btn-primary text-center">
                                Login untuk Checkout
                            </a>
                        @endauth
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-xl font-display text-gray-500 mb-2">Keranjang Kosong</h3>
                    <p class="text-gray-400 mb-6">Belum ada produk di keranjang Anda</p>
                    <a href="{{ route('catalog') }}" class="btn-primary">
                        Mulai Berbelanja
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

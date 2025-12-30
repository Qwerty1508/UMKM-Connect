@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li><a href="{{ route('catalog') }}" class="hover:text-primary">Katalog</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-primary font-medium">{{ Str::limit($product->name, 30) }}</li>
                </ol>
            </nav>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div class="luxury-card overflow-hidden">
                    @if($product->image_path)
                        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full aspect-square object-cover">
                    @else
                        <div class="w-full aspect-square bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Product Details -->
                <div>
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-primary mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-3xl font-bold text-secondary">{{ $product->formatted_price }}</span>
                        @if($product->inStock())
                            <span class="badge-success">Tersedia</span>
                        @else
                            <span class="badge-pending">Stok Habis</span>
                        @endif
                    </div>
                    
                    @if($product->description)
                        <div class="prose prose-lg text-gray-600 mb-8">
                            <p>{{ $product->description }}</p>
                        </div>
                    @endif
                    
                    <div class="border-t border-gray-200 pt-6 mb-8">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Stok: {{ $product->stock }} unit
                        </div>
                    </div>
                    
                    @if($product->inStock())
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="flex items-center gap-4">
                                <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                                <div class="flex items-center border border-gray-200 rounded-lg">
                                    <button type="button" onclick="decreaseQty()" class="px-4 py-2 text-gray-600 hover:bg-gray-100">-</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-16 text-center border-0 focus:ring-0">
                                    <button type="button" onclick="increaseQty({{ $product->stock }})" class="px-4 py-2 text-gray-600 hover:bg-gray-100">+</button>
                                </div>
                            </div>
                            
                            <div class="flex gap-4">
                                <button type="submit" class="flex-1 btn-primary text-lg py-4">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 py-4 rounded-lg cursor-not-allowed text-lg font-medium">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
            
            <!-- Related Products -->
            @if($related_products->count() > 0)
                <section class="mt-20">
                    <h2 class="section-title mb-8">Produk Lainnya</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($related_products as $related)
                            <a href="{{ route('product.show', $related) }}" class="product-card">
                                <div class="relative overflow-hidden">
                                    @if($related->image_path)
                                        <img src="{{ $related->image_path }}" alt="{{ $related->name }}" class="product-image">
                                    @else
                                        <div class="w-full aspect-square bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-display font-semibold text-primary line-clamp-1">{{ $related->name }}</h3>
                                    <p class="text-secondary font-bold">{{ $related->formatted_price }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function decreaseQty() {
        const input = document.getElementById('quantity');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    
    function increaseQty(max) {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    }
</script>
@endpush

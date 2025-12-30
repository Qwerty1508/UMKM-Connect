@props(['product'])

<a href="{{ route('product.show', $product) }}" class="group block h-full">
    <div class="product-card h-full relative group">
        <!-- Image -->
        <div class="relative overflow-hidden aspect-[4/5]">
            <img src="{{ $product->image_path }}" 
                 alt="{{ $product->name }}" 
                 class="product-image w-full h-full object-cover">
            
            <!-- Overlay -->
            <div class="product-overlay flex items-center justify-center">
                <span class="bg-white/90 backdrop-blur-sm text-primary px-6 py-3 rounded-full font-medium text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 shadow-xl">
                    Lihat Detail
                </span>
            </div>
            
            <!-- Stock Badge -->
            @if($product->stock < 5 && $product->stock > 0)
                <div class="absolute top-3 left-3 bg-red-500 text-white text-[10px] uppercase tracking-wider px-2 py-1 rounded-sm font-bold">
                    Terbatas
                </div>
            @elseif($product->stock == 0)
                <div class="absolute top-3 left-3 bg-gray-500 text-white text-[10px] uppercase tracking-wider px-2 py-1 rounded-sm font-bold">
                    Habis
                </div>
            @endif
        </div>
        
        <!-- Content -->
        <div class="p-4 bg-white border-t border-transparent group-hover:border-secondary/20 transition-colors duration-300">
            <h3 class="font-display text-lg text-primary group-hover:text-secondary transition-colors duration-300 mb-1 truncate">
                {{ $product->name }}
            </h3>
            <div class="flex items-center justify-between">
                <p class="text-gold-gradient font-medium">{{ $product->formatted_price }}</p>
                <div class="w-8 h-px bg-gray-200 group-hover:bg-secondary transition-colors duration-300"></div>
            </div>
        </div>
    </div>
</a>

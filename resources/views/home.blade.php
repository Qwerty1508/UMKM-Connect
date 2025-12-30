@extends('layouts.app')

@section('title', 'UMKM Universal - Luxury & Quality')

@section('content')
<!-- Fixed Parallax Background (stays behind all content) -->
<div class="parallax-bg" 
     style="background-image: url('{{ $config['hero_image_url'] ?? 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1920&q=80' }}');">
</div>

<!-- Hero Section -->
<section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/60 via-gray-900/40 to-gray-900/90 mix-blend-multiply"></div>
    
    <!-- Content -->
    <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-16">
        <span class="block text-secondary font-display text-lg md:text-xl tracking-[0.2em] mb-4 reveal-on-scroll uppercase">
            EST. {{ date('Y') }}
        </span>
        
        <h1 class="font-display text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 leading-tight reveal-on-scroll delay-100 drop-shadow-2xl">
            {{ $config['business_name'] ?? 'UMKM Universal' }}
        </h1>
        
        <p class="font-body text-gray-200 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed font-light reveal-on-scroll delay-200">
            {{ $config['tagline'] ?? 'Menghadirkan kualitas terbaik dari tangan pengrajin lokal untuk gaya hidup premium Anda.' }}
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 reveal-on-scroll delay-300">
            <a href="{{ route('catalog') }}" class="btn-secondary min-w-[180px] group">
                <span class="mr-2">Jelajahi Koleksi</span>
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
            <a href="#featured" class="btn-outline border-white text-white hover:bg-white hover:text-gray-900 min-w-[180px]">
                Produk Unggulan
            </a>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-8 h-8 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</section>

<!-- Story Section (Editorial Style) -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative reveal-on-scroll">
                <div class="absolute -top-4 -left-4 w-24 h-24 border-t-2 border-l-2 border-secondary opacity-50"></div>
                <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?w=800&q=80" alt="About Us" class="w-full h-auto rounded-lg shadow-2xl grayscale hover:grayscale-0 transition-all duration-700">
                <div class="absolute -bottom-4 -right-4 w-24 h-24 border-b-2 border-r-2 border-secondary opacity-50"></div>
            </div>
            
            <div class="reveal-on-scroll delay-100">
                <h2 class="section-title text-left mb-6">Cerita <span class="text-gold-gradient">Kami</span></h2>
                <div class="prose prose-lg text-gray-600 font-light">
                    <p class="drop-cap mb-6">
                        {{ $config['about_text'] ?? 'Kami memulai perjalanan ini dengan satu visi sederhana: mengangkat karya pengrajin lokal ke panggung dunia. Setiap produk yang kami kurasi adalah hasil dari dedikasi, keahlian, dan cinta yang mendalam terhadap detail.' }}
                    </p>
                    <p>
                        Kami percaya bahwa kemewahan sejati terletak pada cerita di balik setiap jahitan, setiap ukiran, dan setiap sentuhan. Bergabunglah dengan kami dalam merayakan keindahan yang tak lekang oleh waktu.
                    </p>
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <p class="font-display text-xl text-primary italic">"Quality is never an accident; it is always the result of high intention."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products (Asymmetrical Grid) -->
<section id="featured" class="py-24 bg-accent relative">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-white/30 skew-x-12 transform origin-top-right"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal-on-scroll">
            <span class="text-secondary font-display tracking-widest uppercase text-sm">Kurasi Pilihan</span>
            <h2 class="section-title mt-2">Koleksi <span class="text-gold-gradient">Eksklusif</span></h2>
        </div>
        
        @if(count($featuredProducts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 grid-flow-row-dense">
                <!-- Large Feature Item -->
                <div class="md:col-span-2 md:row-span-2 reveal-on-scroll">
                    @php $first = $featuredProducts->shift(); @endphp
                    <a href="{{ route('product.show', $first) }}" class="group block h-full">
                        <div class="luxury-card h-full relative overflow-hidden">
                            <img src="{{ $first->image_path }}" alt="{{ $first->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <span class="bg-secondary text-white text-xs px-3 py-1 rounded-full mb-3 inline-block">Best Seller</span>
                                <h3 class="font-display text-3xl text-white mb-2">{{ $first->name }}</h3>
                                <p class="text-gray-300 mb-4 line-clamp-2">{{ $first->description }}</p>
                                <span class="text-white font-medium border-b border-secondary pb-1">Lihat Detail</span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Smaller Items -->
                @foreach($featuredProducts->take(2) as $product)
                    <div class="reveal-on-scroll delay-100">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12 reveal-on-scroll">
                <a href="{{ route('catalog') }}" class="btn-outline hover:bg-primary hover:text-white px-8 py-4">
                    Lihat Semua Koleksi
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 italic">Belum ada produk unggulan saat ini.</p>
            </div>
        @endif
    </div>
</section>

<!-- Values Section (Icons) -->
<section class="py-20 bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <div class="reveal-on-scroll p-6 border border-white/10 rounded-2xl bg-white/5 backdrop-blur-sm hover:bg-white/10 transition-colors">
                <div class="w-16 h-16 mx-auto bg-secondary/20 rounded-full flex items-center justify-center mb-6 text-secondary">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold mb-3">Kualitas Terjamin</h3>
                <p class="text-gray-400 font-light">Setiap produk melalui proses kurasi ketat untuk memastikan standar tertinggi.</p>
            </div>
            
            <div class="reveal-on-scroll delay-100 p-6 border border-white/10 rounded-2xl bg-white/5 backdrop-blur-sm hover:bg-white/10 transition-colors">
                <div class="w-16 h-16 mx-auto bg-secondary/20 rounded-full flex items-center justify-center mb-6 text-secondary">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold mb-3">Pengiriman Cepat</h3>
                <p class="text-gray-400 font-light">Layanan logistik premium untuk memastikan barang Anda tiba tepat waktu.</p>
            </div>
            
            <div class="reveal-on-scroll delay-200 p-6 border border-white/10 rounded-2xl bg-white/5 backdrop-blur-sm hover:bg-white/10 transition-colors">
                <div class="w-16 h-16 mx-auto bg-secondary/20 rounded-full flex items-center justify-center mb-6 text-secondary">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold mb-3">Dukungan 24/7</h3>
                <p class="text-gray-400 font-light">Tim layanan pelanggan kami siap membantu Anda kapan saja.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gray-100">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 reveal-on-scroll">
        <h2 class="font-display text-4xl md:text-5xl font-bold text-primary mb-6">Siap Melengkapi Gaya Anda?</h2>
        <p class="text-xl text-gray-600 mb-10 font-light">Bergabunglah dengan ribuan pelanggan puas lainnya dan rasakan perbedaan kualitas kami.</p>
        <a href="{{ route('catalog') }}" class="btn-secondary text-lg px-10 py-4 shadow-xl shadow-secondary/30">
            Mulai Belanja Sekarang
        </a>
    </div>
</section>
@endsection

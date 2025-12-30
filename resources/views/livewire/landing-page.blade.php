<div class="min-h-screen bg-primary">
    {{-- Sticky Header with Blur --}}
    <header class="sticky top-0 z-50 w-full border-b border-white/10 bg-white/70 backdrop-blur-md transition-all">
        <div class="container mx-auto flex h-16 items-center justify-between px-4 lg:px-8">
            {{-- Logo --}}
            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-slate-800">UMKM<span class="text-accent">Market</span></span>
            </div>

            {{-- Location Picker --}}
            <div class="hidden md:flex items-center gap-2 rounded-full bg-white/50 px-4 py-2 shadow-sm border border-slate-200 cursor-pointer hover:bg-white hover:shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-accent">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <span class="text-sm font-medium text-slate-600">Jakarta, Indonesia</span>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-accent px-5 py-2 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition-all hover:bg-indigo-700 hover:scale-105 hover:shadow-indigo-500/50">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <div class="container mx-auto px-4 text-center z-10 relative">
            <h1 class="mb-6 text-5xl font-extrabold tracking-tight text-slate-900 lg:text-7xl font-sans">
                Jelajahi <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600">UMKM Terbaik</span><br>
                Di Sekitar Anda
            </h1>
            <p class="mb-10 text-lg text-slate-600 lg:text-xl max-w-2xl mx-auto">
                Temukan makanan, kerajinan, dan jasa lokal berkualitas tinggi langsung dari ahlinya.
            </p>

            {{-- Search Component Placeholder --}}
            <div class="mx-auto max-w-2xl relative z-20">
                <livewire:search-umkm />
            </div>
        </div>

        {{-- Decorative Blobs --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-500/20 rounded-full blur-3xl -z-10 animate-blob"></div>
    </section>

    {{-- Bento Grid --}}
    <section class="py-12 bg-slate-50">
        <div class="container mx-auto px-4 lg:px-8">
            <h2 class="mb-8 text-2xl font-bold text-slate-900">Pilihan Terdekat</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Example Card --}}
                <div class="group relative overflow-hidden rounded-[16px] bg-white shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl cursor-pointer">
                    <div class="aspect-square w-full overflow-hidden bg-slate-200">
                         <img src="https://placehold.co/400" alt="UMKM" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-2">
                             <span class="inline-flex items-center gap-1 rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Buka</span>
                             <div class="flex items-center gap-1">
                                 <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                 <span class="text-sm font-bold text-slate-700">4.8</span>
                             </div>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Warung Makan Sejahtera</h3>
                        <p class="text-sm text-slate-500">0.5 km • Makanan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

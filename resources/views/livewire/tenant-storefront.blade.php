<div class="min-h-screen pb-24">
    {{-- Tenant Header --}}
    <header class="relative h-64 w-full bg-slate-900 overflow-hidden">
        <img src="{{ $store->banner_url ?? 'https://placehold.co/1200x400' }}" class="h-full w-full object-cover opacity-60">
        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-slate-900 to-transparent p-6">
            <div class="container mx-auto flex items-end gap-6">
                <div class="h-24 w-24 overflow-hidden rounded-full border-4 border-white shadow-xl bg-white">
                    <img src="{{ $store->logo_url ?? 'https://placehold.co/150' }}" class="h-full w-full object-cover">
                </div>
                <div class="mb-2 text-white">
                    <h1 class="text-3xl font-bold">{{ $store->name }}</h1>
                    <p class="text-slate-200">{{ $store->location ?? 'Lokasi tidak tersedia' }}</p>
                </div>
            </div>
        </div>
    </header>

    {{-- Product Grid --}}
    <main class="container mx-auto mt-8 px-4">
        <h2 class="mb-6 text-xl font-bold text-slate-900">Menu Pilihan</h2>
        
        <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-8">
            {{-- Dummy Products --}}
            @foreach(range(1, 8) as $item)
                <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm hover:shadow-lg transition-all">
                    <div class="aspect-square w-full overflow-hidden bg-slate-100">
                        <img src="https://placehold.co/400" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-4">
                        <h3 class="mb-1 font-bold text-slate-900">Nasi Goreng Spesial</h3>
                        <p class="text-xs text-slate-500 mb-3">Lorem ipsum dolor sit amet.</p>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-[var(--primary-color)]">Rp 25.000</span>
                            <button class="rounded-full bg-[var(--primary-color)] p-2 text-white hover:opacity-90 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    {{-- Floating Cart Bar --}}
    <div class="fixed bottom-6 left-1/2 w-[90%] max-w-md -translate-x-1/2 transform rounded-full bg-slate-900 px-6 py-4 text-white shadow-2xl flex items-center justify-between">
        <div class="flex flex-col">
            <span class="text-xs text-slate-400">Total Keranjang</span>
            <span class="font-bold">Rp 0</span>
        </div>
        <button class="rounded-full bg-[var(--primary-color)] px-6 py-2 text-sm font-bold text-white hover:scale-105 transition-transform">
            Checkout (0)
        </button>
    </div>
</div>

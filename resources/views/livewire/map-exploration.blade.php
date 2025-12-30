<div class="relative flex h-[calc(100vh-65px)] w-full overflow-hidden bg-slate-50">
    {{-- Sidebar Store List --}}
    <aside class="w-full max-w-md flex-col overflow-y-auto border-r border-slate-200 bg-white shadow-xl lg:flex z-20 hidden">
        <div class="p-4 border-b border-slate-100 sticky top-0 bg-white/95 backdrop-blur-sm z-10">
            <h2 class="text-lg font-bold text-slate-900">Temukan di Sekitar</h2>
            <p class="text-sm text-slate-500">Menampilkan hasil di area peta saat ini</p>
        </div>
        
        <div class="p-4 space-y-4">
            @forelse($stores as $store)
                <div class="group flex gap-4 cursor-pointer rounded-xl p-3 transition-all hover:bg-slate-50 border border-transparent hover:border-slate-200">
                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-slate-200">
                        <img src="https://placehold.co/200" alt="{{ $store['name'] }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $store['name'] }}</h3>
                        <p class="text-sm text-slate-500">{{ $store['category'] }}</p>
                        <div class="mt-2 flex items-center gap-1">
                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-sm font-semibold">{{ $store['rating'] }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="rounded-full bg-slate-100 p-4 mb-3">
                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    </div>
                    <p class="text-slate-500">Geser peta untuk mencari area lain</p>
                </div>
            @endforelse
        </div>
    </aside>

    {{-- Map Container --}}
    <div wire:ignore id="map" class="h-full w-full bg-slate-200"></div>

    {{-- Mobile Bottom Sheet --}}
    <div class="fixed bottom-0 left-0 right-0 z-30 rounded-t-3xl bg-white shadow-[0_-5px_20px_rgba(0,0,0,0.1)] p-4 lg:hidden transition-transform transform translate-y-[calc(100%-80px)] hover:translate-y-0">
        <div class="mx-auto mb-4 h-1.5 w-12 rounded-full bg-slate-300"></div>
        <h3 class="mb-4 text-lg font-bold text-center">Daftar Toko ({{ count($stores) }})</h3>
        <div class="max-h-[60vh] overflow-y-auto space-y-4">
             @foreach($stores as $store)
                <div class="flex gap-4 rounded-xl border border-slate-100 p-3">
                    <div class="h-16 w-16 shrink-0 overflow-hidden rounded-lg bg-slate-200">
                        <img src="https://placehold.co/150" class="h-full w-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900">{{ $store['name'] }}</h4>
                        <p class="text-xs text-slate-500">{{ $store['category'] }}</p>
                    </div>
                </div>
             @endforeach
        </div>
    </div>
</div>

@assets
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endassets

@script
<script>
    const map = L.map('map').setView([-6.2088, 106.8456], 13);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    function updateUrl() {
        const bounds = map.getBounds();
        Livewire.dispatch('map-moved', { bounds: bounds });
    }

    map.on('moveend', updateUrl);
    
    // Initial call
    updateUrl();
</script>
@endscript

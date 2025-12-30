<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto max-w-3xl px-4">
        <h1 class="mb-8 text-3xl font-bold text-slate-900">Riwayat Pesanan</h1>

        {{-- Tabs --}}
        <div class="mb-8 flex space-x-2 overflow-x-auto pb-2 scrollbar-hide">
            @foreach(['all' => 'Semua', 'active' => 'Sedang Jalan', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $key => $label)
                <button 
                    wire:click="setTab('{{ $key }}')"
                    class="rounded-full px-6 py-2 text-sm font-bold transition-all whitespace-nowrap
                    {{ $activeTab === $key 
                        ? 'bg-slate-900 text-white shadow-md transform scale-105' 
                        : 'bg-white text-slate-500 hover:bg-slate-100' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Orders List --}}
        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="group relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm transition-all hover:shadow-md border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-600"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 0 0 3.75.615V21m-9-6h.008v.008H12V15Zm0 2.25h.008v.008H12V17.25Z" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">Warung Makan Sejahtera</h3>
                                <p class="text-xs text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset 
                            {{ $order->status === 'completed' ? 'bg-green-50 text-green-700 ring-green-600/20' : 
                               ($order->status === 'cancelled' ? 'bg-red-50 text-red-700 ring-red-600/20' : 'bg-yellow-50 text-yellow-800 ring-yellow-600/20') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-slate-600 line-clamp-1">
                            {{-- Placeholder items --}}
                            2x Nasi Goreng Spesial, 1x Es Teh Manis...
                        </p>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-50 pt-4">
                        <div class="flex flex-col">
                            <span class="text-xs text-slate-400">Total Belanja</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex gap-2">
                             @if($order->status === 'completed')
                                <button class="rounded-lg border border-indigo-600 px-4 py-2 text-sm font-bold text-indigo-600 hover:bg-indigo-50 transition-colors">
                                    Beli Lagi
                                </button>
                             @else
                                <a href="{{ route('orders.show', $order) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-bold text-white hover:bg-indigo-700 transition-colors shadow-sm">
                                    Lacak
                                </a>
                             @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center">
                    <div class="mx-auto mb-4 h-24 w-24 opacity-20">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Belum ada pesanan</h3>
                    <p class="text-slate-500">Yuk mulai jelajahi UMKM di sekitarmu!</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>

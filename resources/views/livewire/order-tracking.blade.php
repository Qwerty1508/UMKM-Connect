<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto max-w-2xl px-4">
        
        {{-- Status Card --}}
        <div class="mb-8 overflow-hidden rounded-2xl bg-white shadow-lg">
            <div class="bg-indigo-600 p-6 text-center text-white">
                <h1 class="text-2xl font-bold">Lacak Pesanan</h1>
                <p class="opacity-90">#{{ $order->order_number }}</p>
            </div>
            
            <div class="p-8">
                {{-- QR Code --}}
                <div class="mb-10 flex flex-col items-center justify-center">
                    <div class="rounded-xl border-2 border-dashed border-slate-200 p-4">
                        {!! $qrCode !!}
                    </div>
                    <p class="mt-4 text-center text-sm text-slate-500 max-w-xs">
                        Tunjukkan QR Code ini kepada penjual saat pengambilan pesanan.
                    </p>
                </div>

                {{-- Timeline --}}
                <div class="relative space-y-8 pl-8 before:absolute before:left-3 before:top-2 before:h-[calc(100%-16px)] before:w-0.5 before:bg-slate-200">
                    
                    @php
                        $statuses = ['pending', 'paid', 'processing', 'ready', 'completed'];
                        $currentStep = array_search($order->status, $statuses);
                        $statusLabels = [
                            'pending' => 'Menunggu Pembayaran',
                            'paid' => 'Pembayaran Diterima',
                            'processing' => 'Sedang Diproses',
                            'ready' => 'Siap Diambil',
                            'completed' => 'Selesai'
                        ];
                    @endphp

                    @foreach($statuses as $index => $step)
                        <div class="relative transition-all duration-500 ease-in-out {{ $index <= $currentStep ? 'opacity-100' : 'opacity-40 grayscale' }}">
                            {{-- Dot --}}
                            <div class="absolute -left-[34px] top-1 flex h-6 w-6 items-center justify-center rounded-full border-2 
                                {{ $index <= $currentStep ? 'border-indigo-600 bg-indigo-600' : 'border-slate-300 bg-white' }}">
                                @if($index < $currentStep)
                                    <svg class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                @elseif($index === $currentStep)
                                    <div class="h-2.5 w-2.5 rounded-full bg-white animate-pulse"></div>
                                @endif
                            </div>
                            
                            <h3 class="text-lg font-bold {{ $index === $currentStep ? 'text-indigo-600' : 'text-slate-900' }}">
                                {{ $statusLabels[$step] }}
                            </h3>
                            <p class="text-sm text-slate-500">
                                {{ $index <= $currentStep ? 'Berhasil pada ' . now()->format('H:i') : 'Menunggu proses' }}
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
            
            {{-- Actions --}}
            <div class="border-t border-slate-100 bg-slate-50 p-6 flex gap-4">
                <a href="{{ route('chat') }}" class="flex-1 rounded-xl border border-indigo-600 bg-transparent py-3 text-center font-bold text-indigo-600 transition-colors hover:bg-indigo-50">
                    Hubungi Penjual
                </a>
                <a href="{{ route('home') }}" class="flex-1 rounded-xl bg-slate-900 py-3 text-center font-bold text-white transition-colors hover:bg-slate-800">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

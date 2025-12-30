<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto max-w-3xl px-4">
        <h1 class="mb-8 text-3xl font-bold text-slate-900">Checkout Pesanan</h1>

        <div class="grid gap-8 md:grid-cols-3">
            {{-- Order Summary --}}
            <div class="md:col-span-2 space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-800">Ringkasan Pesanan</h2>
                    <div class="space-y-4">
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                                <div>
                                    <h3 class="font-bold text-slate-900">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-slate-500">{{ $item['quantity'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <span class="font-bold text-slate-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="text-lg font-bold text-slate-800">Total</span>
                        <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Payment & Pickup Form --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-xl font-bold text-slate-800">Detail Pengambilan</h2>
                    
                    <form wire:submit.prevent="processCheckout" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Waktu Pengambilan</label>
                            <input wire:model="pickupTime" type="datetime-local" class="w-full rounded-lg border-slate-200 bg-slate-50 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('pickupTime') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Bukti Pembayaran (Transfer Bank)</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        @if($paymentProof)
                                            <p class="text-sm text-green-600 font-bold">File terpilih: {{ $paymentProof->getClientOriginalName() }}</p>
                                        @else
                                            <svg class="w-8 h-8 mb-4 text-slate-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-slate-500"><span class="font-semibold">Klik untuk upload</span></p>
                                            <p class="text-xs text-slate-500">PNG, JPG (MAX. 1MB)</p>
                                        @endif
                                    </div>
                                    <input wire:model="paymentProof" id="dropzone-file" type="file" class="hidden" />
                                </label>
                            </div>
                            @error('paymentProof') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-indigo-600 px-6 py-4 text-lg font-bold text-white shadow-xl hover:bg-indigo-700 transition-all hover:translate-y-[-2px]">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info Sidebar --}}
            <div class="md:col-span-1">
                <div class="sticky top-24 rounded-2xl bg-indigo-50 p-6">
                    <h3 class="font-bold text-indigo-900 mb-2">Info Pembayaran</h3>
                    <p class="text-sm text-indigo-700 mb-4">Silakan transfer ke rekening berikut:</p>
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <p class="text-xs text-slate-500 uppercase tracking-wider">BCA</p>
                        <p class="text-lg font-mono font-bold text-slate-800">123-456-7890</p>
                        <p class="text-sm text-slate-600">a.n UMKM Connect</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

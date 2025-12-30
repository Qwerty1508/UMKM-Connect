@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="section-title mb-8">Checkout</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2">
                    <div class="luxury-card p-6">
                        <h2 class="font-display text-xl font-semibold text-primary mb-6">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4">
                            @foreach($items as $item)
                                <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                                    <div class="w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden">
                                        @if($item['product']->image_path)
                                            <img src="{{ $item['product']->image_path }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">{{ $item['product']->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $item['quantity'] }} x {{ $item['product']->formatted_price }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-primary">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-6">
                        @csrf
                        <div class="luxury-card p-6">
                            <h2 class="font-display text-xl font-semibold text-primary mb-4">Catatan Pesanan</h2>
                            <textarea name="notes" rows="3" 
                                      placeholder="Tambahkan catatan untuk pesanan Anda (opsional)..."
                                      class="form-input">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button (Mobile) -->
                        <div class="lg:hidden mt-6">
                            <button type="submit" class="w-full btn-secondary text-lg py-4">
                                Buat Pesanan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Order Total -->
                <div class="lg:col-span-1">
                    <div class="luxury-card p-6 sticky top-24">
                        <h2 class="font-display text-xl font-semibold text-primary mb-6">Total Pembayaran</h2>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Biaya Layanan</span>
                                <span class="text-green-600">Gratis</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span class="text-secondary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4 mb-6">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-blue-700">
                                    <p class="font-medium">Pembayaran di Lokasi</p>
                                    <p class="mt-1">Setelah checkout, Anda akan mendapat QR Code. Tunjukkan ke admin saat pengambilan untuk verifikasi.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button (Desktop) -->
                        <form action="{{ route('checkout.process') }}" method="POST" class="hidden lg:block">
                            @csrf
                            <input type="hidden" name="notes" id="desktop-notes">
                            <button type="submit" class="w-full btn-secondary text-lg py-4">
                                Buat Pesanan
                            </button>
                        </form>
                        
                        <a href="{{ route('cart.index') }}" class="block text-center text-gray-500 hover:text-primary mt-4 text-sm">
                            ← Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Sync notes between forms
    const notesTextarea = document.querySelector('textarea[name="notes"]');
    const desktopNotes = document.getElementById('desktop-notes');
    
    if (notesTextarea && desktopNotes) {
        notesTextarea.addEventListener('input', function() {
            desktopNotes.value = this.value;
        });
    }
</script>
@endpush

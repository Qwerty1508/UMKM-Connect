@extends('layouts.admin')

@section('title', 'Scan QR Pesanan')

@push('styles')
<style>
    #reader {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }
    #reader video {
        border-radius: 1rem;
    }
</style>
@endpush

@section('content')
    <div class="mb-8">
        <h1 class="font-display text-2xl font-bold text-primary">Scan QR Pesanan</h1>
        <p class="text-gray-500">Arahkan kamera ke QR Code pelanggan untuk verifikasi</p>
    </div>
    
    <div class="max-w-xl mx-auto" x-data="qrScanner()">
        <!-- Scanner Area -->
        <div class="luxury-card p-6 mb-6">
            <div id="reader" class="mb-4"></div>
            
            <div class="text-center">
                <button @click="startScanner()" x-show="!scanning" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Mulai Scan
                </button>
                
                <button @click="stopScanner()" x-show="scanning" class="btn-ghost border border-gray-200">
                    Berhenti
                </button>
            </div>
        </div>
        
        <!-- Manual Input -->
        <div class="luxury-card p-6 mb-6">
            <h3 class="font-display font-semibold text-primary mb-4">Atau Input Manual</h3>
            <div class="flex gap-3">
                <input type="text" x-model="manualToken" placeholder="Masukkan token QR..." class="form-input flex-1">
                <button @click="verifyToken(manualToken)" class="btn-secondary" :disabled="!manualToken || loading">
                    Verifikasi
                </button>
            </div>
        </div>
        
        <!-- Result -->
        <div x-show="result" x-cloak class="luxury-card p-6">
            <template x-if="result && result.success">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-green-600 mb-2" x-text="result.message"></h3>
                    <template x-if="result.order">
                        <div class="text-left mt-4 pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-1">Pesanan #<span x-text="result.order.id"></span></p>
                            <p class="font-semibold text-primary" x-text="result.order.user?.name"></p>
                            <p class="text-secondary font-bold mt-2">
                                Rp <span x-text="new Intl.NumberFormat('id-ID').format(result.order.total_amount)"></span>
                            </p>
                        </div>
                    </template>
                    <button @click="result = null; manualToken = ''" class="btn-primary mt-6">
                        Scan Lagi
                    </button>
                </div>
            </template>
            
            <template x-if="result && !result.success">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-red-600 mb-2" x-text="result.message"></h3>
                    <button @click="result = null; manualToken = ''" class="btn-outline mt-4">
                        Coba Lagi
                    </button>
                </div>
            </template>
        </div>
        
        <!-- Loading -->
        <div x-show="loading" class="luxury-card p-6 text-center">
            <svg class="animate-spin h-8 w-8 text-secondary mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-500 mt-2">Memverifikasi...</p>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    function qrScanner() {
        return {
            scanning: false,
            loading: false,
            result: null,
            manualToken: '',
            html5QrCode: null,
            
            startScanner() {
                this.result = null;
                this.scanning = true;
                
                this.html5QrCode = new Html5Qrcode("reader");
                
                this.html5QrCode.start(
                    { facingMode: "environment" },
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    (decodedText) => {
                        this.stopScanner();
                        this.verifyToken(decodedText);
                    },
                    (errorMessage) => {
                        // Ignore errors during scanning
                    }
                ).catch((err) => {
                    console.error('Camera error:', err);
                    this.scanning = false;
                    alert('Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.');
                });
            },
            
            stopScanner() {
                if (this.html5QrCode && this.scanning) {
                    this.html5QrCode.stop().then(() => {
                        this.scanning = false;
                    }).catch((err) => {
                        console.error('Stop error:', err);
                    });
                }
            },
            
            async verifyToken(token) {
                if (!token) return;
                
                this.loading = true;
                this.result = null;
                
                try {
                    const response = await fetch('{{ route('admin.orders.verify') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ qr_code_token: token })
                    });
                    
                    const data = await response.json();
                    this.result = data;
                } catch (error) {
                    this.result = {
                        success: false,
                        message: 'Terjadi kesalahan. Silakan coba lagi.'
                    };
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endpush

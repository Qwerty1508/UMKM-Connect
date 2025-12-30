@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ route('customer.orders') }}" class="inline-flex items-center text-gray-500 hover:text-primary mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Pesanan
            </a>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Header -->
                    <div class="luxury-card p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="font-display text-2xl font-bold text-primary">
                                Pesanan #{{ $order->id }}
                            </h1>
                            @if($order->isPending())
                                <span class="badge-pending text-sm">Menunggu Verifikasi</span>
                            @else
                                <span class="badge-success text-sm">Selesai</span>
                            @endif
                        </div>
                        <p class="text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    
                    <!-- Items -->
                    <div class="luxury-card p-6">
                        <h2 class="font-display text-lg font-semibold text-primary mb-4">Detail Produk</h2>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
                                    <div class="w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden">
                                        @if($item->product->image_path)
                                            <img src="{{ $item->product->image_path }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-800">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-primary">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="border-t border-gray-200 mt-4 pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-secondary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    @if($order->notes)
                        <div class="luxury-card p-6">
                            <h2 class="font-display text-lg font-semibold text-primary mb-2">Catatan</h2>
                            <p class="text-gray-600">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
                
                <!-- QR Code -->
                <div class="lg:col-span-1">
                    <div class="luxury-card p-6 sticky top-24">
                        <h2 class="font-display text-lg font-semibold text-primary text-center mb-4">
                            QR Code Pesanan
                        </h2>
                        
                        <div class="flex justify-center mb-4">
                            <div class="p-4 bg-white rounded-xl shadow-inner">
                                {!! $qrCode !!}
                            </div>
                        </div>
                        
                        @if($order->isPending())
                            <div class="bg-blue-50 rounded-lg p-4 text-center">
                                <p class="text-sm text-blue-700">
                                    Tunjukkan QR Code ini kepada admin saat pengambilan pesanan
                                </p>
                            </div>
                        @else
                            <div class="bg-green-50 rounded-lg p-4 text-center">
                                <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-green-700 font-medium">
                                    Pesanan telah diverifikasi
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

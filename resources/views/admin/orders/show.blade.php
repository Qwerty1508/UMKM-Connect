@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-gray-500 hover:text-primary mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Pesanan
        </a>
        <div class="flex items-center justify-between">
            <h1 class="font-display text-2xl font-bold text-primary">Pesanan #{{ $order->id }}</h1>
            @if($order->isPending())
                <span class="badge-pending text-sm">Menunggu Verifikasi</span>
            @else
                <span class="badge-success text-sm">Selesai</span>
            @endif
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Info -->
            <div class="luxury-card p-6">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Informasi Pelanggan</h2>
                <div class="flex items-center gap-4">
                    @if($order->user->avatar)
                        <img src="{{ $order->user->avatar }}" alt="" class="w-12 h-12 rounded-full">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-800">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
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
        
        <!-- Order Info -->
        <div>
            <div class="luxury-card p-6 sticky top-24">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Info Pesanan</h2>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">ID Pesanan</span>
                        <span class="font-medium">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal</span>
                        <span>{{ $order->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Waktu</span>
                        <span>{{ $order->created_at->format('H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        @if($order->isPending())
                            <span class="text-yellow-600 font-medium">Menunggu</span>
                        @else
                            <span class="text-green-600 font-medium">Selesai</span>
                        @endif
                    </div>
                </div>
                
                <div class="border-t border-gray-200 mt-4 pt-4">
                    <p class="text-xs text-gray-400 mb-2">QR Token</p>
                    <code class="text-xs text-gray-600 break-all">{{ $order->qr_code_token }}</code>
                </div>
            </div>
        </div>
    </div>
@endsection

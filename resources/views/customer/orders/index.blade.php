@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="section-title mb-8">Pesanan Saya</h1>
            
            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <a href="{{ route('customer.orders.show', $order) }}" class="block luxury-card p-6 hover:shadow-xl transition-shadow">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="font-display font-semibold text-primary">Order #{{ $order->id }}</span>
                                        @if($order->isPending())
                                            <span class="badge-pending">Menunggu</span>
                                        @else
                                            <span class="badge-success">Selesai</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->items->count() }} produk</p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Total</p>
                                    <p class="text-xl font-bold text-secondary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            @if($order->isPending())
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <p class="text-sm text-blue-600 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Klik untuk melihat QR Code
                                    </p>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-xl font-display text-gray-500 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-gray-400 mb-6">Anda belum memiliki pesanan</p>
                    <a href="{{ route('catalog') }}" class="btn-primary">
                        Mulai Berbelanja
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

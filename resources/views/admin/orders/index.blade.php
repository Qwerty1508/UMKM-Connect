@extends('layouts.admin')

@section('title', 'Pesanan')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-display text-2xl font-bold text-primary">Pesanan</h1>
            <p class="text-gray-500">Kelola semua pesanan pelanggan</p>
        </div>
        <a href="{{ route('admin.orders.scan') }}" class="btn-secondary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            Scan QR
        </a>
    </div>
    
    <!-- Filters -->
    <div class="luxury-card p-4 mb-6">
        <div class="flex gap-2">
            <a href="{{ route('admin.orders.index') }}" 
               class="px-4 py-2 rounded-lg transition-colors {{ !request('status') ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                Semua
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
               class="px-4 py-2 rounded-lg transition-colors {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                Pending
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'success']) }}" 
               class="px-4 py-2 rounded-lg transition-colors {{ request('status') == 'success' ? 'bg-green-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                Selesai
            </a>
        </div>
    </div>
    
    @if($orders->count() > 0)
        <div class="luxury-card overflow-hidden">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="font-medium text-primary">#{{ $order->id }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if($order->user->avatar)
                                        <img src="{{ $order->user->avatar }}" alt="" class="w-8 h-8 rounded-full">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span>{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $order->items->count() }} produk</td>
                            <td class="font-semibold text-secondary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                @if($order->isPending())
                                    <span class="badge-pending">Pending</span>
                                @else
                                    <span class="badge-success">Selesai</span>
                                @endif
                            </td>
                            <td class="text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="text-blue-600 hover:underline text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $orders->withQueryString()->links() }}
        </div>
    @else
        <div class="luxury-card p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="font-display text-lg text-gray-500 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-400">Pesanan akan muncul di sini setelah pelanggan checkout</p>
        </div>
    @endif
@endsection

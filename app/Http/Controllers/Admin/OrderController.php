<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display orders list
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->latest();

        if ($request->has('status') && in_array($request->status, ['pending', 'success'])) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show QR scanner page
     */
    public function scan()
    {
        return view('admin.orders.scan');
    }

    /**
     * Verify order via QR code
     */
    public function verify(Request $request)
    {
        $request->validate([
            'qr_code_token' => 'required|string',
        ]);

        $order = Order::where('qr_code_token', $request->qr_code_token)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.',
            ], 404);
        }

        if ($order->isSuccess()) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan ini sudah diverifikasi sebelumnya.',
                'order' => $order->load('user'),
            ], 400);
        }

        $order->markAsSuccess();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diverifikasi!',
            'order' => $order->load(['user', 'items.product']),
        ]);
    }
}

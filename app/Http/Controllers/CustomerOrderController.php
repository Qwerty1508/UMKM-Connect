<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\QRCodeService;

class CustomerOrderController extends Controller
{
    protected QRCodeService $qrService;

    public function __construct(QRCodeService $qrService)
    {
        $this->qrService = $qrService;
    }

    /**
     * Show customer orders
     */
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Show order detail with QR code
     */
    public function show(Order $order)
    {
        // Check ownership
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');
        
        $qrCode = $this->qrService->generateQRCode($order->qr_code_token, 250);

        return view('customer.orders.show', compact('order', 'qrCode'));
    }
}

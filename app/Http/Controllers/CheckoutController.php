<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\QRCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected QRCodeService $qrService;

    public function __construct(QRCodeService $qrService)
    {
        $this->qrService = $qrService;
    }

    /**
     * Show checkout page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->is_active && $product->inStock()) {
                $items[] = [
                    'product' => $product,
                    'quantity' => min($quantity, $product->stock),
                    'subtotal' => $product->price * min($quantity, $product->stock),
                ];
                $total += $product->price * min($quantity, $product->stock);
            }
        }

        if (empty($items)) {
            return redirect()->route('cart.index')
                ->with('error', 'Tidak ada produk yang tersedia di keranjang.');
        }

        return view('checkout', compact('items', 'total'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            $orderItems = [];

            foreach ($cart as $productId => $quantity) {
                $product = Product::lockForUpdate()->find($productId);
                
                if (!$product || !$product->is_active || !$product->inStock()) {
                    continue;
                }

                $qty = min($quantity, $product->stock);
                $price = $product->price;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                ];

                $total += $price * $qty;

                // Reduce stock
                $product->decrement('stock', $qty);
            }

            if (empty($orderItems)) {
                DB::rollBack();
                return redirect()->route('cart.index')
                    ->with('error', 'Tidak ada produk yang tersedia.');
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'qr_code_token' => $this->qrService->generateToken(),
                'status' => 'pending',
                'total_amount' => $total,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            return redirect()->route('customer.orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat! Tunjukkan QR Code kepada admin untuk verifikasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
}

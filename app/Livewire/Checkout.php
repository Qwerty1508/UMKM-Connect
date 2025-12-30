<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Checkout extends Component
{
    use WithFileUploads;

    public $pickupTime;
    public $paymentProof;
    public $cart = []; // Simulated cart for prototype
    public $total = 0;

    public function mount()
    {
        // Simulated cart data
        $this->cart = [
            [
                'id' => 1,
                'name' => 'Nasi Goreng Spesial',
                'price' => 25000,
                'quantity' => 2,
                'subtotal' => 50000
            ],
            [
                'id' => 2,
                'name' => 'Es Jeruk',
                'price' => 5000,
                'quantity' => 2,
                'subtotal' => 10000
            ]
        ];

        $this->total = collect($this->cart)->sum('subtotal');
    }

    public function processCheckout()
    {
        $this->validate([
            'pickupTime' => 'required|date',
            'paymentProof' => 'required|image|max:1024', // 1MB Max
        ]);

        $path = $this->paymentProof->store('payment-proofs', 'public');

        $order = Order::create([
            'user_id' => Auth::id() ?? 1, // Fallback
            'store_id' => 1, // Fallback
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount' => $this->total,
            'status' => 'pending',
            'payment_proof' => $path,
            'pickup_time' => $this->pickupTime,
        ]);

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('orders.show', $order);
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }
}

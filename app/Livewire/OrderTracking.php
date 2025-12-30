<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Order;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderTracking extends Component
{
    public Order $order;
    public $qrCode;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->generateQrCode();
    }

    public function generateQrCode()
    {
        // Generate QR Code for order verification
        $this->qrCode = QrCode::size(200)->generate($this->order->order_number);
    }

    #[On('echo-private:orders.{order.id},OrderStatusUpdated')]
    public function updateStatus($event)
    {
        $this->order->refresh();
        $this->order->status = $event['status'];
    }

    public function render()
    {
        return view('livewire.order-tracking')->layout('layouts.app');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;

class AdminDashboard extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin-dashboard', [
            'totalUsers' => User::count(),
            'totalStores' => Store::count(),
            'totalOrders' => Order::count(),
            'pendingStores' => Store::where('is_open', false)->count(), // Using is_open as proxy for verification
        ]);
    }
}

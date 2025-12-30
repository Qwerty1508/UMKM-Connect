<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    use WithPagination;

    public $activeTab = 'all';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function render()
    {
        // Prototype: Return empty pagination or dummy data if DB fails
        // In real app: Order::where('user_id', Auth::id())
        
        $query = Order::query(); // Placeholder for Auth::user()->orders()

        if ($this->activeTab === 'active') {
             $query->whereIn('status', ['pending', 'paid', 'processing', 'ready']);
        } elseif ($this->activeTab === 'completed') {
             $query->where('status', 'completed');
        } elseif ($this->activeTab === 'cancelled') {
             $query->where('status', 'cancelled');
        }

        return view('livewire.order-history', [
            'orders' => $query->latest()->paginate(10)
        ])->layout('layouts.app');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SellerDashboard extends Component
{
    #[Layout('layouts.seller-panel')]
    public function render()
    {
        return view('livewire.seller-dashboard');
    }
}

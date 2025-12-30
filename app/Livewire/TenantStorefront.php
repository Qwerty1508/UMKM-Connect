<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Store;

class TenantStorefront extends Component
{
    public Store $store;

    public function mount(Store $store)
    {
        $this->store = $store;
    }

    #[Layout('layouts.tenant')]
    public function render()
    {
        return view('livewire.tenant-storefront');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class SearchUmkm extends Component
{
    public $query = '';

    public function render()
    {
        return view('livewire.search-umkm');
    }
}

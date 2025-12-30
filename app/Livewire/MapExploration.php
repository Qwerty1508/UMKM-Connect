<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MapExploration extends Component
{
    public $stores = [];
    public $southWest;
    public $northEast;

    public function render()
    {
        return view('livewire.map-exploration')->layout('layouts.app');
    }

    #[On('map-moved')] 
    public function updateMap($bounds)
    {
        $this->southWest = $bounds['_southWest'];
        $this->northEast = $bounds['_northEast'];

        // Simulated query for prototype (replace with DB::spatial query later)
        $this->stores = [
            [
                'id' => 1,
                'name' => 'Warung Makan Sejahtera',
                'lat' => -6.200000,
                'lng' => 106.816666,
                'category' => 'Food',
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'name' => 'Laundry Kilat',
                'lat' => -6.210000,
                'lng' => 106.820000,
                'category' => 'Service',
                'rating' => 4.5
            ]
        ];
    }
}

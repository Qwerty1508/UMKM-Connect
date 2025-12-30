<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellerRegistration extends Component
{
    use WithFileUploads;

    public $step = 1;

    // Step 1: Basic Info
    public $name = '';
    public $slug = '';
    public $description = '';
    
    // Step 2: Location
    public $location = '';
    public $latitude;
    public $longitude;

    // Step 3: Documents
    public $idCard;
    public $businessLicense;

    public function nextStep()
    {
        $this->validate($this->getValidationRules());
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function getValidationRules()
    {
        if ($this->step == 1) {
            return [
                'name' => 'required|min:3',
                'slug' => 'required|unique:stores,slug',
                'description' => 'required',
            ];
        } elseif ($this->step == 2) {
            return [
                'location' => 'required',
            ];
        } else {
            return [
                'idCard' => 'required|image|max:2048',
            ];
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function registerStore()
    {
        $this->validate($this->getValidationRules());

        $idCardPath = $this->idCard->store('documents', 'public');
        
        Store::create([
            'user_id' => Auth::id() ?? 1,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'location' => $this->location,
            'latitude' => -6.2, // Dummy
            'longitude' => 106.8, // Dummy
            'is_open' => false,
        ]);

        return redirect()->route('dashboard'); // Redirect to seller dashboard
    }

    public function render()
    {
        return view('livewire.seller-registration')->layout('layouts.app');
    }
}
